<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Notifications\SmokeAlertNotif;
use Vonage\Client;
use Vonage\Client\Credentials\Basic as VonageBasic;

class SmokeDetectorController extends Controller
{
    /**
     * Poll the Blynk API for smoke level (V0) and warning status (V1),
     * and send email and SMS notifications when a warning is triggered.
     */
    public function monitorSmoke()
    {
        $authToken = env('BLYNK_AUTH_TOKEN');
        if (!$authToken) {
            return response()->json(['error' => 'Blynk Auth Token is not configured.'], 500);
        }

        try {
            // Explicitly fetch data for V1 (warning status) and V0 (smoke level)
            $warningStatus = $this->fetchWarningStatus($authToken);
            $smokeLevel = $this->fetchSmokeLevel($authToken);

            if ($warningStatus) {
                $this->notifyUsers($smokeLevel);
                return response()->json([
                    'message' => 'Warning triggered. Notifications sent to all users via email and SMS.',
                    'smoke_level' => $smokeLevel,
                ]);
            }

            return response()->json([
                'message' => 'No warning triggered.',
                'smoke_level' => $smokeLevel,
                'warning_status' => $warningStatus,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Fetch the smoke level (V0) from Blynk API.
     *
     * @param string $authToken
     * @return int
     * @throws \Exception
     */
    private function fetchSmokeLevel(string $authToken): int
    {
        $url = "https://sgp1.blynk.cloud/external/api/get?token={$authToken}&V0";
        $response = file_get_contents($url);

        if ($response === false) {
            throw new \Exception("Failed to fetch smoke level data from Blynk API.");
        }

        return intval($response);
    }

    /**
     * Fetch the warning status (V1) from Blynk API.
     *
     * @param string $authToken
     * @return bool
     * @throws \Exception
     */
    private function fetchWarningStatus(string $authToken): bool
    {
        $url = "https://sgp1.blynk.cloud/external/api/get?token={$authToken}&V1";
        $response = file_get_contents($url);

        if ($response === false) {
            throw new \Exception("Failed to fetch warning status data from Blynk API.");
        }

        return boolval($response);
    }

    /**
     * Notify all users via email and SMS.
     *
     * @param int $smokeLevel
     * @return void
     */
    private function notifyUsers(int $smokeLevel)
    {
        // Notify users via Laravel Notification
        $users = User::all();
        Notification::send($users, new SmokeAlertNotif($smokeLevel));

        // Notify users via Vonage SMS
        $vonage = new Client(new VonageBasic(
            env('VONAGE_API_KEY'),
            env('VONAGE_API_SECRET')
        ));

        foreach ($users as $user) {
            if ($user->phone) {
                $vonage->sms()->send(
                    new \Vonage\SMS\Message\SMS(
                        $user->phone,
                        'SmokeSense',
                        "Warning: Smoke levels are critical! Current level: {$smokeLevel}. Please take immediate action."
                    )
                );
            }
        }
    }
}
