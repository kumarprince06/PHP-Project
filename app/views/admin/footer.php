  <!-- <div id="loader"></div> -->

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="<?php echo URLROOT ?>/public/js/admin-dashboard.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
      const ctx = document.getElementById('salesChart').getContext('2d');
      const salesChart = new Chart(ctx, {
          type: 'line',
          data: {
              labels: ['January', 'February', 'March', 'April', 'May', 'June'],
              datasets: [{
                  label: 'Sales',
                  data: [120, 190, 300, 500, 200, 300],
                  borderColor: 'rgba(54, 162, 235, 1)',
                  backgroundColor: 'rgba(54, 162, 235, 0.2)',
                  borderWidth: 2,
                  tension: 0.4
              }]
          },
          options: {
              responsive: true,
              plugins: {
                  legend: {
                      position: 'top',
                  }
              }
          }
      });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
      // Daily Revenue Data
      const dailyData = {
          labels: ['12 AM', '3 AM', '6 AM', '9 AM', '12 PM', '3 PM', '6 PM', '9 PM'],
          datasets: [{
              label: 'Revenue (in $)',
              data: [100, 150, 200, 300, 400, 350, 450, 500],
              backgroundColor: 'rgba(75, 192, 192, 0.2)',
              borderColor: 'rgba(75, 192, 192, 1)',
              borderWidth: 2,
              tension: 0.4
          }]
      };

      // Monthly Revenue Data
      const monthlyData = {
          labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
          datasets: [{
              label: 'Revenue (in $)',
              data: [1500, 2000, 2500, 3000],
              backgroundColor: 'rgba(54, 162, 235, 0.2)',
              borderColor: 'rgba(54, 162, 235, 1)',
              borderWidth: 2,
              tension: 0.4
          }]
      };

      // Yearly Revenue Data
      const yearlyData = {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          datasets: [{
              label: 'Revenue (in $)',
              data: [12000, 15000, 13000, 16000, 18000, 20000, 25000, 22000, 24000, 26000, 28000, 30000],
              backgroundColor: 'rgba(255, 206, 86, 0.2)',
              borderColor: 'rgba(255, 206, 86, 1)',
              borderWidth: 2,
              tension: 0.4
          }]
      };

      // Daily Revenue Chart
      new Chart(document.getElementById('dailyRevenueChart'), {
          type: 'line',
          data: dailyData,
          options: {
              responsive: true,
              plugins: {
                  legend: {
                      position: 'top'
                  }
              }
          }
      });

      // Monthly Revenue Chart
      new Chart(document.getElementById('monthlyRevenueChart'), {
          type: 'bar',
          data: monthlyData,
          options: {
              responsive: true,
              plugins: {
                  legend: {
                      position: 'top'
                  }
              }
          }
      });

      // Yearly Revenue Chart
      new Chart(document.getElementById('yearlyRevenueChart'), {
          type: 'line',
          data: yearlyData,
          options: {
              responsive: true,
              plugins: {
                  legend: {
                      position: 'top'
                  }
              }
          }
      });
  </script>
  <!-- DataTables JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

  </body>

  </html>