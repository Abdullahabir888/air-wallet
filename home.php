<?php require_once "controllerUserData.php"; ?>
<?php
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if ($email != false && $password != false) {
  $sql = "SELECT * FROM user WHERE email = '$email'";
  $run_Sql = mysqli_query($con, $sql);
  if ($run_Sql) {
    $fetch_info = mysqli_fetch_assoc($run_Sql);
    $status = $fetch_info['status'];
    $code = $fetch_info['code'];
    if ($status == "verified") {
      if ($code != 0) {
        header('Location: reset-code.php');
      }
    } else {
      header('Location: user-otp.php');
    }
  }
} else {
  header('Location: login-user.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashbord wallet</title>
  <!-- MATERIAL ICONS CDN -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
  <!--GF Poppins-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!--Stylesheet-->
  <style>
    /* Root CSS VARIABLES */
    :root {
      --color-white: #ffffff;
      --color-light: #f0eff5;
      --color-gray-light: #86848c;
      --color-gray-dark: #56555e;
      --color-dark: #27282f;
      --color-primary: rgb(71, 7, 234);
      --color-success: rgb(34, 202, 75);
      --color-danger: rgb(255, 67, 54);
      --color-warning: rgb(234, 181, 7);
      --color-purple: rgb(160, 99, 245);

      --color-primary-light: rgb(71, 7, 234, 0.2);
      --color-success-light: rgb(160, 202, 75, 0.2);
      --color-danger-light: rgb(255, 67, 54, 0.2);
      --color-purple-light: rgb(160, 99, 245, 0.2);

      --card-padding: 1.6rem;
      --padding-1: 1rem;
      --padding-2: 8px;

      --card-border-radius: 1.6rem;
      -border-radius-1: 1rem;
      -border-radius-2: 6px;
    }

    .dark-theme {
      --color-white: #131316;
      --color-light: #23232a;
      --color-dark: #ddd;
      --color-gray-dark: #adacb5;
    }

    * {
      margin: 0;
      padding: 0;
      outline: 0;
      border: 0;
      appearance: none;
      text-decoration: none;
      list-style: none;
      box-sizing: border-box;
    }

    html {
      font-size: 12px;
    }

    body {
      background: var(--color-light);
      font-family: poppins, sans-serif;
      min-height: 100vh;
      color: var(--color-dark);
    }

    img {
      width: 100%;
    }

    h1 {
      font-size: 2.2rem;
    }

    h2 {
      font-size: 1.5rem;
    }

    h3 {
      font-size: 1.2rem;
    }

    h4 {
      font-size: 1rem;
    }

    h5 {
      font-size: 0.86rem;
      font-weight: 500;
    }

    h6 {
      font-size: 0.76rem;
    }

    p {
      font-size: 0.86rem;
      color: var(--color-gray-dark);
    }

    small {
      font-weight: 300;
      font-size: 0.77rem;
    }

    .text-muted {
      color: var(--color-gray-light);
    }

    .primary {
      color: var(--color-primary);
    }

    .danger {
      color: var(--color-danger);
    }

    .success {
      color: var(--color-success);
    }

    .purple {
      color: var(--color-purple);
    }

    .bg-primary {
      background: var(--color-primary);
      box-shadow: 0 0.8rem 0.8rem var(--color-primary-light);
    }

    .bg-danger {
      background: var(--color-danger);
      box-shadow: 0 0.8rem 0.8rem var(--color-danger-light);
    }

    .bg-success {
      background: var(--color-success);
      box-shadow: 0 0.8rem 0.8rem var(--color-success-light);
    }

    .bg-purple {
      background: var(--color-purple);
      box-shadow: 0 0.8rem 0.8rem var(--color-purple-light);
    }

    .bg-dark {
      background: #27282f;
      box-shadow: 0 0.8rem 0.8rem rgba(0, 0, 0, 0.2);
    }

    .bg-purple-light {
      background: var(--color-purple-light);
    }

    .bg-danger-light {
      background: var(--color-danger-light);
    }

    .bg-primary-light {
      background: var(--color-primary-light);
    }

    .bg-success-light {
      background: var(--color-success-light);
    }


    /*---------- NAV BAR-----------*/
    nav {
      width: 100%;
      background: var(--color-white);
      padding: 1rem 0;
    }

    nav .container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: relative;
      width: 96%;
      margin: 0 auto;
    }

    nav img.logo {
      width: 7rem;
    }

    nav .search-bar {
      background: var(--color-light);
      padding: var(--padding-2) var(--card-padding);
      width: 32vw;
      border-radius: var(--border-radius-2);
      display: flex;
      align-items: center;
      gap: 1rem;
      color: var(--color-gray-light);
      position: absolute;
      left: 15%;
    }

    nav .search-bar input[type='search'] {
      color: var(--color-dark);
      background: transparent;
      width: 100%;
    }

    nav .search-bar input[type='search']::placeholder {
      color: var(--color-grey-dark);
    }

    nav .profile-area {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 4rem;
    }

    nav .profile-area .theme-btn {
      display: flex;
      background: var(--color-light);
      width: 5rem;
      height: 2rem;
      border-radius: var(--border-radius-2);
      cursor: pointer;
    }

    nav .profile-area .theme-btn span {
      width: 50%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.3rem;
    }

    nav .profile-area .theme-btn .active {
      background: var(--color-dark);
      border-radius: var(--border-radius-2);
      color: var(--color-white);
    }

    nav .profile-area .profile {
      display: flex;
      gap: 1rem;
      align-items: center;
    }

    nav .profile-area .profile-photo {
      display: block;
      width: 3rem;
      height: 3rem;
      border-radius: 50%;
      overflow: hidden;
    }

    nav .profile-area > button {
      display: none;
    }

    /*----------------- ASIDE & SIDEBAR----------------*/
    main {
      display: grid;
      grid-template-columns: 16rem auto 30rem;
      gap: 2rem;
      width: 96%;
      margin: 1rem auto 4rem;
    }

    main aside {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 88vh;
    }

    /* will be shown only on mobile and tablets */
    main aside button#close-btn {
      display: none;
    }

    main aside .sidebar a {
      display: flex;
      align-items: center;
      gap: 1.2rem;
      height: 4.2rem;
      color: var(--color-gray-light);
      position: relative;
    }

    main aside .sidebar a span {
      font-size: 1.7rem;
      margin-left: 3rem;
      transition: all 300ms ease;
    }

    main aside .sidebar a.active {
      background: var(--color-white);
      color: var(--color-primary);
    }

    main aside .sidebar a.active:before {
      content: '';
      width: 6px;
      height: 100%;
      position: absolute;
      background: var(--color-primary);
    }

    main aside .sidebar a:hover {
      color: var(--color-primary);
    }

    main aside .sidebar a:hover span {
      margin-left: 2rem;
    }

    main aside .sidebar h4 {
      font-weight: 500;
    }

    /* ----------- updates---------*/
    main aside .updates {
      background: var(--color-white);
      border-radius: var(--border-radius-1);
      text-align: center;
      padding: var(--card-padding);
    }

    main aside .updates span {
      font-size: 2.8rem;
    }

    main aside .updates h4 {
      margin: 1rem 0;
    }

    main aside .updates a {
      display: block;
      width: 100%;
      background: var(--color-primary);
      color: var(--color-white);
      border-radius: var(--border-radius-1);
      padding: 0.8rem 0;
      margin-top: 2rem;
      transition: all 300ms ease;
    }

    main aside .updates a:hover {
      box-shadow: 0 1rem 2rem var(--color-primary-light);
    }

    /*-------------- MIDDLE---------------*/
    main section.middle .header {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    main section.middle .header input[type='date'] {
      padding: 0.5rem 2rem;
      border-radius: var(--border-radius-2);
      background: var(--color-white);
      color: var(--color-gray-dark);
    }

    main section.middle .cards {
      margin-top: 1rem;
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.5rem;
    }

    main section.middle .cards .card {
      background: linear-gradient(#38ef7d, #59C173);
      padding: var(--card-padding);
      border-radius: var(--card-border-radius);
      color: white;
      height: 16rem;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      box-shadow: 0 2rem 3rem var(--color-danger-light);
      transition: all 300ms ease;
      min-width: 22rem;
      cursor: pointer;
    }


    main section.middle .cards .card:nth-child(2) {
      background: linear-gradient(#7f8191, #7f8191);
      box-shadow: 0 2rem 3rem rgba(0, 0, 0, 0.2);
    }

    main section.middle .cards .card:nth-child(3) {
      background: linear-gradient(#5d70ff, #5719c2);
      box-shadow: 0 2rem 3rem var(--color-primary-light);
    }

    main section.middle .cards .card:hover {
      box-shadow: none;
    }

    main section.middle .cards .top {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    main section.middle .cards .top .left {
      display: flex;
      gap: 0.5rem;

    }

    main section.middle .cards .top .left h2 {
      font-weight: 200;
      font-size: 1.3rem;
    }

    main section.middle .card .top .left img {
      width: 2.3rem;
      height: 2.3rem;
      border: 1px solid white;
      border-radius: var(--border-radius-2);
      padding: 0.4rem;
    }

    main section.middle .card .top .right {
      width: 3.5rem;
    }

    main section.middle .card .middle {
      display: flex;
      justify-content: space-between;
    }

    main section.middle .card .middle .chip {
      width: 3.7rem;
    }

    main section.middle .card .bottom {
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
    }

    main section.middle .card .bottom .right {
      display: flex;
      gap: 2rem;
    }

    /*---------------MONTHLY REPORT-----------*/

    main .monthly-report {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1rem;
      justify-content: space-between;
      margin-top: 2rem;
    }

    main .monthly-report h1 {
      font-weight: 700;
      font-size: 1.8rem;
    }

    /*--------------- FAST PAYMENT -----------*/
    main .fast-payment {
      margin-top: 2rem;
      display: flex;
      align-self: center;
      gap: 2rem;
    }

    main .fast-payment .badges {
      display: flex;
      gap: 1rem;
      align-self: center;
      flex-wrap: wrap;
      max-width: 100%;
    }

    main .fast-payment .badge span {
      width: 7px;
      height: 7px;
      border-radius: 50%;
    }

    main .fast-payment .badge {
      padding: 0.6rem var(--card-padding);
      background: var(--color-white);
      border-radius: var(--border-radius-2);
      display: flex;
      align-items: center;
      gap: 1rem;
      transition: all 300ms ease;
    }

    main .fast-payment .badge:hover {
      box-shadow: 0 0 1.5rem var(--color-primary-light);
      cursor: pointer;
    }


    main .fast-payment .badge:first-child span {
      display: flex;
      align-self: center;
      justify-content: center;
      height: fit-content;
      font-size: 1.5rem;
    }

    main .fast-payment .badge div {
      display: flex;
      gap: 2rem;
      align-self: center;
    }

    /*---------------   CANVAS -----------*/

    canvas#chart {
      background: var(--color-white);
      max-width: 100%;
      margin-top: 2rem;
      border-radius: var(--card-border-radius);
      padding: var(--card-padding);
    }

    /*---------------   INVESTMENTS  -----------*/
    main section.right .investments {
      background: var(--color-white);
      border-radius: var(--card-border-radius);
    }

    main section.right .investments img {
      width: 2.4rem;
    }

    main section.right .investments .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: var(--card-padding);
      padding-bottom: 0;
    }

    main section.right .investments .header a {
      display: flex;
      align-items: center;
      color: var(--color-primary);
    }

    main section.right .investments .investment {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: var(--card-padding);
      border-bottom: 1px solid var(--color-light);
      transition: all 300ms ease;
    }

    main section.right .investments .investment:last-child {
      border: none;
    }

    main section.right .investments .investment:hover {
      background: var(--color-light);
      cursor: pointer;
    }

    /*--------------- RECENT TRANSACTIONS -----------*/
    main .recent-transactions {
      margin-top: 2rem;
    }

    main .recent-transactions img {
      width: 2.2rem;
    }

    main .recent-transactions .header {
      display: flex;
      justify-content: space-between;
      margin-bottom: 1rem;
    }

    main .recent-transactions .header a {
      display: flex;
      align-items: center;
      color: var(--color-primary);
    }

    main .recent-transactions .transaction {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 1.5rem var(--card-padding);
      border-radius: var(--card-border-radius);
      transition: all 300ms ease;
    }

    main .recent-transactions .transaction:hover {
      background: var(--color-white);
      cursor: pointer;
    }

    main .recent-transactions .transaction .service {
      display: flex;
      gap: 1rem;
    }

    main .recent-transactions .transaction .service .icon {
      padding: var(--padding-2);
      border-radius: var(--border-radius-1);
      display: flex;
      align-items: center;
    }

    main .recent-transactions .card-details {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    main .recent-transactions .transaction .card-details .card {
      display: flex;
      width: 4.6rem;
      height: 3rem;
      align-items: center;
      border-radius: var(--border-radius-2);
    }

    .active .badge {
      font-size: 0.8rem;
      padding: 0.3rem 0.5rem;
      background: #fff;
      color: #000;
      border-radius: 0.5rem;
    }

    .dropdown {
      position: relative;
      display: inline-block;
      cursor: pointer;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f4f4f4;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      padding: 12px 0;
      z-index: 1;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

    .dropdown-content button,
    .dropdown-content a {
      display: flex;
      padding: 5px 10px;
      color: #333;
    }

    .dropdown-content button {
      width: 100%;
    }

    .dropdown-content button:hover,
    .dropdown-content a:hover {
      background-color: #e8e8e8;
    }

  </style>
</head>

<body>
  <nav>
    <div class="container">
      <img src="logo.png" class="logo">
      <div class="search-bar">
        <span class="material-symbols-sharp">search</span>
        <input type="search" placeholder="Search">
      </div>
      <div class="profile-area">
        <div class="theme-btn">
          <span class="material-symbols-sharp active">light_mode</span>
          <span class="material-symbols-sharp">dark_mode</span>
        </div>
        <div class="dropdown">
          <div class="profile">
            <div class="profile-photo">
              <img src=<?php echo $fetch_info['image'] ?>>
            </div>
            <h5><?php echo $fetch_info['name'] ?></h5>
            <span class="material-symbols-sharp">expand_more</span>
          </div>
          <div class="dropdown-content">
            <a href="profile.php">Profile</a>
            <a href="logout-user.php">logout</a>
            
          </div>
        </div>

        <button id="menu-btn">
          <span class="material-symbols-sharp">menu</span>
        </button>
      </div>
    </div>
  </nav>
  <!--END OF NAVBAR-->

  <main>
    <aside>
      <button id="close-btn">
        <span class="material-symbols-sharp">close</span>
      </button>

      <div class="sidebar">
        <a href="home.php" class="active">
          <span class="material-symbols-sharp">dashboard</span>
          <h4>Dashboard</h4>
        </a>
        <a href="Exchange.php">
          <span class="material-symbols-sharp">currency_exchange</span>
          <h4>Exchange</h4>
        </a>

        </a>
        <a href="#">
          <span class="material-symbols-sharp">payment</span>
          <h4>Transaction</h4>
        </a>
        <a href="#">
          <span class="material-symbols-sharp">pie_chart</span>
          <h4>Analytics</h4>
        </a>
        <a href="#">
          <span class="material-symbols-sharp">help_center</span>
          <h4>Help Center</h4>
        </a>
        <a href="#">
          <span class="material-symbols-sharp">settings</span>
          <h4>Settings</h4>
        </a>
      </div>
      <!-----------END OF SIDEBAR-------->

      <div class="updates">

      </div>


    </aside>
    <!--END OF ASIDE-->
    <section class="middle">
      <div class="header">
        <h1>Overview</h1>
        <input type="date">
      </div>

      <div class="cards">
        <div class="card">
          <div class="top">
            <div class="left">
              <img src="images/BTC.png">
              <h2>BTC</h2>
            </div>
            <img src="images/visa.png" class="right">
          </div>
          <div class="middle">
            <h1 class="amount">$452,198</h1>
            <img src="images/card chip.png" class="chip">
          </div>
          <div class="bottom">
            <div class="left">
              <small>Card Holder</small>
              <h5><?php echo $fetch_info['name'] ?></h5>
            </div>
            <div class="active">
            </div>
            <div class="right">
              <div class="expiry">
                <small>Expiry</small>
                <h5>08/23</h5>
              </div>
              <div class="cvv">
                <small>CVV</small>
                <h5>933</h5>
              </div>
            </div>
          </div>

        </div>
        <!--------END OF CARD 1------->
        <div class="card">
          <div class="top">
            <div class="left">
              <img src="images/ETH.png">
              <h2>ETH</h2>
            </div>
            <img src="images/master card.png" class="right">
          </div>
          <div class="middle">
            <h1 class="amount">$96,734</h1>
            <div class="chip">
              <img src="images/card chip.png" class="chip">
            </div>
          </div>
          <div class="bottom">
            <div class="left">
              <small>Card Holder</small>
              <h5><?php echo $fetch_info['name'] ?></h5>
            </div>
            <div class="active">
            </div>
            <div class="right">
              <div class="expiry">
                <small>Expiry</small>
                <h5>08/23</h5>
              </div>
              <div class="CVV">
                <small>Expiry</small>
                <h5>753</h5>
              </div>
            </div>
          </div>

        </div>
        <!--------END OF CARD 2------->

        <div class="card">
          <div class="top">
            <div class="left">
              <img src="images/BTC.png">
              <h2>BTC</h2>
            </div>
            <img src="images/visa.png" class="right">
          </div>
          <div class="middle">
            <h1 class="amount">$714,384</h1>
            <div class="chip">
              <img src="images/card chip.png" class="chip">
            </div>

          </div>
          <div class="bottom">
            <div class="left">
              <small>Card Holder</small>
              <h5><?php echo $fetch_info['name'] ?><Jhoney Gunzalez</h5>
            </div>
            <div class="active">
            </div>
            <div class="right">
              <div class="expiry">
                <small>Expiry</small>
                <h5>08/24</h5>
              </div>
              <div class="CVV">
                <small>Expiry</small>
                <h5>856</h5>
              </div>
            </div>
          </div>

        </div>
        <!--------END OF CARD 3------->
      </div>
      <!--------END OF CARDS------->

      <div class="monthly-report">
        <div class="report">
          <h3>Income</h3>
          <div>
            <details>
              <h1>29,035</h1>
              <h3 class="success">+3.5%</h3>
            </details>
            <p class="text-muted">Compared to $26,938 last month</p>
          </div>
        </div>
        <!--------END OF INCOME REPORT------->
        <div class="report">
          <h3>Expenses</h3>
          <div>
            <details>
              <h1>$94,006</h1>
              <h3 class="danger"> -6.5%</h3>
            </details>
            <p class="text-muted">Compared to $26,938 last month</p>
          </div>
        </div>
        <!--------END OF EXPENSES REPORT------->
        <div class="report">
          <h3>Cashback</h3>
          <div>
            <details>
              <h1>$9,008</h1>
              <h3 class="success">+7.1%</h3>
            </details>
            <p class="text-muted">Compared to $26,938 last month</p>
          </div>
        </div>
        <!--------END OF CASHBACK REPORT------->
        <div class="report">
          <h3>Income</h3>
          <div>
            <details>
              <h1>$118,224</h1>
              <h3 class="danger"> -17.8%</h3>
            </details>
            <p class="text-muted">Compared to $26,938 last month</p>
          </div>
        </div>
        <!--------END OF TURNOVER REPORT------->
      </div>

      <!--------END OF MONTHLY REPORT------->

      <div class="fast-payment">
        <h2>Fast Payment</h2>
        <div class="badges">
          <div class="badge">
            <span class="material-symbols-sharp">add</span>
            
<!--  
            
          </div>
           <div class="badge">
              <span class="bg-primary"></span>
              <div>
                <h5 onclick="confirmAction()">Training</h5>
                <h4>$50</h4>
              </div>
            </div>
            <div class="badge">
              <span class="bg-success"></span>
              <div>
                <h5>Internet</h5>
                <h4>$40</h4>
              </div>
            </div>
            <div class="badge">
              <span class="bg-primary"></span>
              <div>
                <h5>Gas</h5>
                <h4>$190</h4>
              </div>
            </div>
            <div class="badge">
              <span class="bg-danger"></span>
              <div>
                <h5>Movies</h5>
                <h4>$35</h4>
              </div>
            </div>
            <div class="badge">
              <span class="bg-primary"></span>
              <div>
                <h5>Education</h5>
                <h4>$999</h4>
              </div>
            </div>
            <div class="badge">
              <span class="bg-danger"></span>
              <div>
                <h5>Electricity</h5>
                <h4>$109</h4>
              </div>
            </div>
            <div class="badge">
              <span class="bg-success"></span>
              <div>
              <button onclick="confirmAction()">Food</button>
                <h5>Food</h5>
                <h4>$399</h4>
              </div> -->
            </div> 
        </div>
      </div> 
      <!--------END OF  FAST PAYMENT------->

      <canvas id="chart"></canvas>

    </section>
    <!-----------END OF MIDDLE-------->

    <section class="right">
      <div class="investments">
        <div class="header">
          <h2>Investments</h2>
          <a href="#">More <span class="material-symbols-sharp">chevron_right</span></a>
        </div>

        <div class="investment">
          <img src="images/uniliver.png">
          <h4>Uniliver</h4>
          <div class="date-time">
            <p>7 Nov, 2022</p>
            <small class="text-muted">9:14pm</small>
          </div>
          <div class="bonds">
            <p>1402</p>
            <small class="text-muted">Bonds</small>
          </div>
          <div class="amount">
            <h4>$20,033</h4>
            <small class="danger"> -4.27%</small>
          </div>
        </div>
        <!-----------END OF INVESTMENT-------->
        <div class="investment">
          <img src="images/tesla.png">
          <h4>Tesla</h4>
          <div class="date-time">
            <p>7 Nov, 2022</p>
            <small class="text-muted">9:14pm</small>
          </div>
          <div class="bonds">
            <p>1402</p>
            <small class="text-muted">Bonds</small>
          </div>
          <div class="amount">
            <h4>$20,033</h4>
            <small class="success"> -4.27%</small>
          </div>
        </div>
        <!-----------END OF INVESTMENT-------->
        <div class="investment">
          <img src="images/monster.png">
          <h4>Monster</h4>
          <div class="date-time">
            <p>7 Nov, 2022</p>
            <small class="text-muted">9:14pm</small>
          </div>
          <div class="bonds">
            <p>1402</p>
            <small class="text-muted">Bonds</small>
          </div>
          <div class="amount">
            <h4>$20,033</h4>
            <small class="sucess"> +6.66%</small>
          </div>
        </div>
        <!-----------END OF INVESTMENT-------->
        <div class="investment">
          <img src="images/mcdonalds.png">
          <h4>McDonalds</h4>
          <div class="date-time">
            <p>7 Nov, 2022</p>
            <small class="text-muted">9:14pm</small>
          </div>
          <div class="bonds">
            <p>1402</p>
            <small class="text-muted">Bonds</small>
          </div>
          <div class="amount">
            <h4>$20,033</h4>
            <small class="danger">36.09%</small>
          </div>
        </div>
        <!-----------END OF INVESTMENT-------->
      </div>
      <!-----------------------END OF INVESTMENTS--------------------->

      <div class="recent-transactions">
        <div class="header">
          <h2>Recent Transaction</h2>
          <a href="#">More <span class="material-symbols-sharp">chevron_right</span></a>
        </div>

        <div class="transaction">
          <div class="service">
            <div class="icon bg-purple-light">
              <span class="material-symbols-sharp purple">headset_mic</span>
            </div>
            <div class="details">
              <h4>Music</h4>
              <p>20.11.2022</p>
            </div>
          </div>
          <div class="card-details">
            <div class="card bg-danger">
              <img src="images/visa.png">
            </div>
            <div class="details">
              <P> *2757</P>
              <small class="text-muted">Credit Card</small>
            </div>
          </div>
          <h4> -$20</h4>
        </div>
        <!-----------END OF TRANSACTION-------->
        <div class="transaction">
          <div class="service">
            <div class="icon bg-purple-light">
              <span class="material-symbols-sharp purple">shopping_bag</span>
            </div>
            <div class="details">
              <h4>Shopping</h4>
              <p>21.11.2022</p>
            </div>
          </div>
          <div class="card-details">
            <div class="card bg-purple">
              <img src="images/visa.png">
            </div>
            <div class="details">
              <P> *1920</P>
              <small class="text-muted">Credit Card</small>
            </div>
          </div>
          <h4> -$899</h4>
        </div>
        <!-----------END OF TRANSACTION-------->
        <div class="transaction">
          <div class="service">
            <div class="icon bg-success-light">
              <span class="material-symbols-sharp success">restaurant</span>
            </div>
            <div class="details">
              <h4>Resturant</h4>
              <p>19.11.2022</p>
            </div>
          </div>
          <div class="card-details">
            <div class="card bg-dark">
              <img src="images/master card.png">
            </div>
            <div class="details">
              <P> *8273</P>
              <small class="text-muted">Master Card</small>
            </div>
          </div>
          <h4> -$50</h4>
        </div>
        <!-----------END OF TRANSACTION-------->
        <div class="transaction">
          <div class="service">
            <div class="icon bg-purple-light">
              <span class="material-symbols-sharp danger">sports_esports</span>
            </div>
            <div class="details">
              <h4>Games</h4>
              <p>15.11.2022</p>
            </div>
          </div>
          <div class="card-details">
            <div class="card bg-danger">
              <img src="images/visa.png">
            </div>
            <div class="details">
              <P> *2757</P>
              <small class="text-muted">Credit Card</small>
            </div>
          </div>
          <h4> -$64</h4>
        </div>
        <!-----------END OF TRANSACTION-------->
        <div class="transaction">
          <div class="service">
            <div class="icon bg-purple-light">
              <span class="material-symbols-sharp danger">medication</span>
            </div>
            <div class="details">
              <h4>Pharmacy</h4>
              <p>15.11.2022</p>
            </div>
          </div>
          <div class="card-details">
            <div class="card bg-danger">
              <img src="images/visa.png">
            </div>
            <div class="details">
              <P> *1921</P>
              <small class="text-muted">Credit Card</small>
            </div>
          </div>
          <h4> -$30</h4>
        </div>
        <!-----------END OF TRANSACTION-------->
        <div class="transaction">
          <div class="service">
            <div class="icon bg-success-light">
              <span class="material-symbols-sharp success">fitness_center</span>
            </div>
            <div class="details">
              <h4>Fitness</h4>
              <p>12.11.2022</p>
            </div>
          </div>
          <div class="card-details">
            <div class="card bg-dark">
              <img src="images/master card.png">
            </div>
            <div class="details">
              <P> *8273</P>
              <small class="text-muted">Credit Card</small>
            </div>
          </div>
          <h4> -$45</h4>
        </div>
        <!-----------END OF TRANSACTION-------->
      </div>
      <!-------------------------END OF TRANSACTIONS--------------------------->
    </section>
    <!-----------END OF RIGHT-------->
  </main>
  <!-----------END OF ASIDE-------->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="./wallet.js"></script>
</body>

</html>
