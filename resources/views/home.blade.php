@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-4">
  <h1 class="text-center">IoT Smoke Monitoring System</h1>
  <p class="text-center">Created by: Techno Trailblazer</p>

  <!-- Status Banner -->
  <div id="statusBanner" class="alert alert-secondary text-center">
    Checking smoke levels...
  </div>

  <!-- Smoke Level Display -->
  <div class="row mt-4 justify-content-center">
    <div class="col-lg-6 col-md-8 col-sm-10">
      <div class="card text-center shadow-sm">
        <div class="card-header bg-primary text-white">Current Smoke Level</div>
        <div class="card-body">
          <h2 id="smokeLevelDisplay" class="text-primary display-4">0</h2>
          <p>Threshold: <span id="threshold" class="font-weight-bold">100</span></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Smoke Level History -->
  <div class="row mt-4">
    <div class="col-lg-12">
      <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">Smoke Level History</div>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Smoke Level</th>
                <th>Timestamp</th>
              </tr>
            </thead>
            <tbody id="smokeHistory"></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const threshold = 100; // Smoke level threshold
  let smokeHistory = []; // Store smoke data (max 10 entries)

  async function fetchSmokeData() {
    try {
      const response = await fetch('/smoke-level');
      if (!response.ok) throw new Error('Failed to fetch smoke data');

      const { smoke_level: smokeLevel } = await response.json();
      const timestamp = new Date().toLocaleString();
      const isWarning = smokeLevel > threshold;

      // Update status banner
      document.getElementById('statusBanner').className = 
        `alert text-center ${isWarning ? 'alert-danger' : 'alert-success'}`;
      document.getElementById('statusBanner').textContent = 
        isWarning ? "Emergency Alert: Smoke levels have exceeded the safe threshold, indicating potential fire danger. Please take immediate action and call 09317218777 (TNT) or 09560283472 for assistance (Del Carmen BFP)." : "All clear: Smoke levels are normal.";

      // Update smoke level display
      document.getElementById('smokeLevelDisplay').textContent = smokeLevel;

      // Update history (keep last 10 entries)
      smokeHistory.unshift({ smokeLevel, timestamp });
      if (smokeHistory.length > 10) smokeHistory.pop();
      renderSmokeHistory();
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  }

  function renderSmokeHistory() {
    const tableBody = document.getElementById('smokeHistory');
    tableBody.innerHTML = smokeHistory
      .map((entry, index) => `
        <tr>
          <td>${index + 1}</td>
          <td>${entry.smokeLevel}</td>
          <td>${entry.timestamp}</td>
        </tr>`)
      .join('');
  }

  // Poll every 3 seconds
  setInterval(fetchSmokeData, 3000);

  // Initial fetch on page load
  fetchSmokeData();
</script>
@endsection
