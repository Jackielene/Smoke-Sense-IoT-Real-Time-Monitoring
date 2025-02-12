<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SmokeAlertController extends Controller
{
    public function fetchData()
    {
        $authToken = env('BLYNK_AUTH_TOKEN');
        $smokeLevelUrl = "https://sgp1.blynk.cloud/external/api/get?token={$authToken}&V0";
        $warningStatusUrl = "https://sgp1.blynk.cloud/external/api/get?token={$authToken}&V1";

        // Fetch data from Blynk virtual pins
        $smokeLevel = intval(file_get_contents($smokeLevelUrl)) ?: 0;
        $warningStatus = boolval(file_get_contents($warningStatusUrl)) ?: false;

        // Threshold for smoke alert
        $threshold = 60; // Customize the threshold value if naeeded

        // Check if smoke level exceeds the threshold
        if ($smokeLevel > $threshold) {
            $this->triggerSmokeAlert($authToken); // Trigger notification
        }

        // Return data for website display
        return response()->json([
            'smoke_level' => $smokeLevel,
            'warning_status' => $warningStatus,
        ]);
    }

    private function triggerSmokeAlert($authToken)
    {
        $logEventUrl = "https://blynk.cloud/external/api/logEvent?token={$authToken}&code=smoke_alert_detected";

        // Trigger Blynk log event
        $response = Http::get($logEventUrl);

        if ($response->successful()) {
            \Log::info("Smoke alert triggered successfully in Blynk.");
        } else {
            \Log::error("Failed to trigger smoke alert in Blynk. Response: " . $response->body());
        }
    }
}
