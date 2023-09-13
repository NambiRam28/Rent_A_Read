<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rent-A-Read</title>
  <link rel="stylesheet" href="graph.css">
  <style>
    body {
  margin: 0;
  padding: 0;
}

nav {
  background-color: #a13232;
  padding: 10px;
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: white;
  font-weight: bold;
  font-size: 20px;
}

.nav-menu {
  list-style: none;
  display: flex;
  gap: 20px;
}

.container {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  padding: 20px;
}

.chart-container {
  width: 48%;
  background-color: white;
  padding: 20px;
  color: white;
  margin-left:240px;
}

canvas {
  width: 100%;
  height: 300px;
}
</style>
</head>

<body style="background-image: url('background1.jpeg');">
<div class="navbar">
    <h3 class="navbar-title">
        <i class="fas fa-book"></i>
        RENT-A-READ
    </h3>
       
        <a href="home.php" class="nav-icon">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
        <a href="borrow.php" class="nav-icon">
            <i class="fas fa-hand-holding"></i>
            <span>Borrow</span>
        </a>
        <a href="profile.php" class="nav-icon">
            <i class="fas fa-user"></i>
            <span>Profile</span>
        </a>
        <a href="graph.php" class="nav-icon">
        <i class="bi bi-graph-up"></i>
            <span>Graph</span>
        </a>
        <a href="logout.php" class="nav-icon">
            <i class="fas fa-sign-in-alt"></i>
            <span>Log Out</span>
        </a>
       
        
    </div>

  <div class="container">
    <div class="chart-container">
      <canvas id="chart1"></canvas>
    </div>
    <div class="chart-container">
      <canvas id="chart2"></canvas>
    </div>
    <div class="chart-container">
      <canvas id="chart3"></canvas>
    </div>
    <div class="chart-container">
      <canvas id="chart4"></canvas>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script >// Sample data for the charts (random values for representation)
const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
const booksRentedByMonth = Array.from({ length: 12 }, () => Math.floor(Math.random() * 100));
const booksBorrowedByBook = ['The Art of Invisibility ', 'Ghost In The Wires', 'Hacking: The Art of Exploitation','Don’t make me think revisited','CSS Mastery: Advanced Web Standards Solutions'].map(() => Math.floor(Math.random() * 100));
const booksRentedByDepartment = ['ECE', 'EE', 'IT', 'CSE', 'MECH'].map(() => Math.floor(Math.random() * 100));
const booksRentedByDomain = ['Cybersecurity', 'Web Development', 'Networks', 'AI', 'Data Science'].map(() => Math.floor(Math.random() * 100));
// Chart 1: Line graph for months with highest no. of books rented
const chart1Ctx = document.getElementById('chart1').getContext('2d');
const chart1 = new Chart(chart1Ctx, {
  type: 'line',
  data: {
    labels: months,
    datasets: [{
      label: 'Books Rented',
      data: booksRentedByMonth,
      backgroundColor: 'rgba(255, 99, 132, 0.2)',
      borderColor: 'rgba(255, 99, 132, 1)',
      borderWidth: 1
    }]
  },
  options: {}
});

// Chart 2: Bar graph for highest borrowed books
const chart2Ctx = document.getElementById('chart2').getContext('2d');
const chart2 = new Chart(chart2Ctx, {
  type: 'bar',
  data: {
    labels: ['The Art of Invisibility ', 'Ghost In The Wires', 'Hacking: The Art of Exploitation','Don’t make me think revisited','CSS Mastery: Advanced Web Standards Solutions'],
    datasets: [{
      label: 'Books Borrowed',
      data: booksBorrowedByBook,
      backgroundColor: 'rgba(54, 162, 235, 0.2)',
      borderColor: 'rgba(54, 162, 235, 1)',
      borderWidth: 1
    }]
  },
  options: {}
});

// Chart 3: Bar graph for departments with the highest books rented
const chart3Ctx = document.getElementById('chart3').getContext('2d');
const chart3 = new Chart(chart3Ctx, {
  type: 'bar',
  data: {
    labels: ['ECE', 'EE', 'IT', 'CSE', 'MECH'],
    datasets: [{
      label: 'Books Rented',
      data: booksRentedByDepartment,
      backgroundColor: 'rgba(255, 206, 86, 0.2)',
      borderColor: 'rgba(255, 206, 86, 1)',
      borderWidth: 1
    }]
  },
  options: {}
});

// Chart 4: Bar graph for domains with the highest books rented
const chart4Ctx = document.getElementById('chart4').getContext('2d');
const chart4 = new Chart(chart4Ctx, {
  type: 'bar',
  data: {
    labels: ['Cybersecurity', 'Web Development', 'Networks', 'AI', 'Data Science'],
    datasets: [{
      label: 'Books Rented',
      data: booksRentedByDomain,
      backgroundColor: 'rgba(75, 192, 192, 0.2)',
      borderColor: 'rgba(75, 192, 192, 1)',
      borderWidth: 1
    }]
  },
  options: {}
});
</script>
</body>

</html>