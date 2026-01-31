<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Thank You – Reward Claimed</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Poppins',sans-serif;
}

body{
  min-height:100vh;
  background:radial-gradient(circle at top, #1a1a1a, #000);
  display:flex;
  align-items:center;
  justify-content:center;
  color:#fff;
  overflow:hidden;
}

/* glowing background animation */
body::before{
  content:'';
  position:absolute;
  inset:0;
  background:linear-gradient(120deg, transparent, rgba(255,215,0,.08), transparent);
  animation:shine 6s linear infinite;
}

@keyframes shine{
  from{transform:translateX(-100%)}
  to{transform:translateX(100%)}
}

.card{
  position:relative;
  max-width:650px;
  padding:50px 40px;
  background:rgba(255,255,255,.05);
  border-radius:28px;
  text-align:center;
  backdrop-filter:blur(18px);
  box-shadow:0 0 50px rgba(255,215,0,.35);
  animation:pop 0.6s ease;
}

@keyframes pop{
  from{transform:scale(.85);opacity:0}
  to{transform:scale(1);opacity:1}
}

.tick{
  width:90px;
  height:90px;
  border-radius:50%;
  background:linear-gradient(135deg, gold, orange);
  margin:0 auto 25px;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:46px;
  color:#000;
  box-shadow:0 0 35px gold;
  animation:pulse 1.4s infinite;
}

@keyframes pulse{
  50%{transform:scale(1.15)}
}

h1{
  font-size:2.4rem;
  color:gold;
  margin-bottom:18px;
}

p{
  font-size:15px;
  line-height:1.8;
  color:#e0e0e0;
  margin-bottom:22px;
}

.footer{
  margin-top:30px;
  font-size:13px;
  color:#aaa;
}
</style>
</head>

<body>

<div class="card">
  <div class="tick">✔</div>

  <h1>Thank You!</h1>

<p>
  Thank you for submitting your reward claim. We’re happy to confirm that your request has been successfully received
  and securely recorded in our system. Your participation in this campaign is highly appreciated.
</p>

<p>
  Our verification team will carefully review the details and images you have provided. Once verification is completed,
  the reward amount will be processed and credited to your registered UPI ID within the specified time frame.
</p>

<p>
  If any additional information is required, our team may contact you using the details you shared.
  Thank you for trusting us and being a valued part of our journey.
</p>


  <div class="footer">
    © {{ date('Y') }} Eemotrack India • All Rights Reserved
  </div>
</div>

</body>
</html>
