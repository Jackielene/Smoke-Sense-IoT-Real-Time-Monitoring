@extends('layouts.app')

@section('content')
    <div class="container my-5 pt-5">
        <h1 class="text-center mb-4 text-dark font-weight-bold">SmokeSense - IoT Smoke Detection System</h1>

        <p class="lead text-center text-muted mb-5">
            SmokeSense is an advanced IoT-based smoke detection system designed to improve response times and reliability in fire emergencies. 
            With real-time notifications and smart integration, it ensures faster, safer, and more efficient responses to fire hazards.
        </p>

        <div class="row mt-4">
            <!-- Key Features Section -->
            <div class="col-md-6 mb-4 section">
                <h3 class="text-primary font-weight-bold mb-4">Key Features</h3>
                <ul class="list-group">
                    <li class="list-group-item py-3 px-4 mb-3"><strong>Real-Time Alerts:</strong> Immediate SMS and email notifications when smoke levels exceed the threshold, keeping you informed and safe.</li>
                    <li class="list-group-item py-3 px-4 mb-3"><strong>IoT Integration:</strong> Uses an ESP32 microcontroller and an MQ-135 gas sensor to monitor smoke levels and send data to the cloud via the Blynk API.</li>
                    <li class="list-group-item py-3 px-4 mb-3"><strong>Accurate Detection:</strong> The system triggers an alert when the smoke level surpasses a pre-defined threshold (e.g., 200), ensuring timely action.</li>
                    <li class="list-group-item py-3 px-4 mb-3"><strong>Mobile-Friendly Interface:</strong> Users can monitor smoke levels and receive alerts from any device through the web-based application.</li>
                </ul>
            </div>

            <!-- How It Works Section -->
            <div class="col-md-6 mb-4 section">
                <h3 class="text-primary font-weight-bold mb-4">How It Works</h3>
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body pb-4">
                        <p class="lead text-muted">Our system utilizes an IoT-based architecture, combining hardware and software components for real-time monitoring and alerts:</p><br>
                        <ul>
                            <li class="mb-3"><strong>ESP32 Microcontroller:</strong> Acts as the central hub, collecting data from the smoke sensor and sending it to the web application via the Blynk API.</li>
                            <li class="mb-3"><strong>MQ-135 Gas Sensor:</strong> Detects smoke and harmful gases in the air. The sensor sends the data to the ESP32 for analysis.</li>
                            <li class="mb-3"><strong>Blynk API:</strong> Facilitates real-time communication between the IoT device (ESP32) and the Laravel-based web application.</li>
                            <li class="mb-3"><strong>Laravel Web Application:</strong> Displays real-time data, sends alerts, and allows users to interact with the system.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vision Section -->
        <div class="text-center mt-5 section">
            <h3 class="font-weight-bold">Our Vision</h3>
            <p class="lead text-muted">
                We aim to provide an easy-to-use, reliable, and affordable smoke detection system for homes, offices, and other environments. 
                Our goal is to save lives and minimize property damage by providing faster fire detection and response.
            </p>
        </div>

        <!-- Contact Us Section -->
        <div class="text-center mt-5 section">
            <h3 class="font-weight-bold">Contact Us</h3>
            <p>If you have any questions or suggestions, feel free to reach out to us:</p>
            <ul class="list-inline">
                <li class="list-inline-item"><strong>Email:</strong> <a href="mailto:smokesense8@gmail.com" class="text-primary">smokesense8@gmail.com</a></li>
            </ul>
        </div>
    </div>
@endsection
