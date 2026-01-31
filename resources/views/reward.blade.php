<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mega Prize Eemotrack India</title>
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
*{box-sizing:border-box;margin:0;padding:0;font-family:'Poppins',sans-serif}

/* BACKGROUND */
#bg-video{position:fixed;inset:0;width:100%;height:100%;object-fit:cover;z-index:-3}
.video-overlay{position:fixed;inset:0;background:linear-gradient(to bottom,rgba(0,0,0,.75),rgba(0,0,0,.9));z-index:-2}

/* CONFETTI */
.confetti-container{position:fixed;inset:0;pointer-events:none;z-index:5}
.confetti-container span{position:absolute;top:-20px;width:8px;height:14px;animation:fall linear infinite}
@keyframes fall{to{transform:translateY(110vh) rotate(720deg);opacity:0}}

/* CARD */
.winner-card{
  max-width:420px;width:92%;margin:10vh auto;padding:28px;
  background:rgba(255,255,255,.12);backdrop-filter:blur(14px);
  border-radius:24px;text-align:center;color:#fff;
  box-shadow:0 0 45px rgba(255,215,0,.45)
}
input,textarea,button{width:100%;padding:13px;margin-top:12px;border:none;border-radius:14px;font-size:15px}
input,textarea{background:#fff}
button{background:linear-gradient(135deg,gold,orange);font-weight:600;cursor:pointer}
.amount{font-size:3.4rem;color:gold;text-shadow:0 0 30px gold;animation:pulse 1.4s infinite}
@keyframes pulse{50%{transform:scale(1.15)}}

/* POPUP */
#popup{display:none;position:fixed;inset:0;background:rgba(0,0,0,.85);z-index:20}
.party-popup{
  max-width:850px;width:95%;margin:5vh auto;
  background:linear-gradient(135deg,#fff,#ffeaa7);
  border-radius:26px;box-shadow:0 0 45px gold;
  animation:zoom .4s ease;overflow:hidden
}
@keyframes zoom{from{transform:scale(.7);opacity:0}to{transform:scale(1);opacity:1}}

.popup-grid{display:grid;grid-template-columns:1fr 1fr}
.popup-left{padding:25px}
.popup-right{padding:25px;background:rgba(0,0,0,.05)}
.party-popup h2{color:#d35400;margin-bottom:10px}

/* FIELD + TICK */
.field{position:relative}
.tick{position:absolute;right:14px;top:50%;transform:translateY(-50%);font-size:18px;font-weight:700}
.tick.ok{color:green}
.tick.bad{color:red}

/* PHOTO */
.photo-row{display:flex;gap:12px;margin:12px 0}
.photo-preview{
  flex:1;height:90px;border:2px dashed #f39c12;border-radius:14px;
  background:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer
}
.photo-preview img{width:100%;height:100%;object-fit:cover;border-radius:12px}

/* DISCLAIMER */
.disclaimer h3{color:#c0392b;margin-bottom:12px}
.disclaimer ul{list-style:none;font-size:13px;color:#333}
.disclaimer li{margin-bottom:10px;padding-left:22px;position:relative}
.disclaimer li::before{content:"✔";position:absolute;left:0;color:green}

/* CAMPAIGN */
.campaign-box{
  margin-top:20px;padding:15px;background:#fff;border-radius:14px;
  text-align:center;box-shadow:0 0 12px rgba(0,0,0,.1)
}
.blink{color:red;font-weight:700;animation:blink 1s infinite}
@keyframes blink{50%{opacity:0}}

@media(max-width:768px){
  .popup-grid{grid-template-columns:1fr}
}
.photo-preview {
  position: relative;
}

.photo-preview img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 12px;
}
#statusModal{
  position:fixed;
  inset:0;
  background:rgba(0,0,0,.85);
  z-index:50;
  display:flex;
  align-items:center;
  justify-content:center;
}

.status-card{
  width:95%;
  max-width:600px;
  background:linear-gradient(135deg,#111,#000);
  color:#fff;
  border-radius:24px;
  padding:30px;
  animation:zoomIn .4s ease;
  box-shadow:0 0 40px gold;
  position:relative;
}

@keyframes zoomIn{
  from{transform:scale(.7);opacity:0}
  to{transform:scale(1);opacity:1}
}

.status-card h2{
  text-align:center;
  color:gold;
  margin-bottom:20px;
}

.status-card img{
  width:100%;
  border-radius:14px;
  margin-top:12px;
}

.close{
  position:absolute;
  top:15px;
  right:20px;
  cursor:pointer;
  font-size:18px;
}

</style>
</head>

<body>

<div class="confetti-container"></div>

<video id="bg-video" autoplay muted loop playsinline>
  <source src="/bg.mp4" type="video/mp4">
</video>
<div class="video-overlay"></div>

<!-- MAIN CARD -->
<div class="winner-card">
  <img src="{{ asset('newlogo.png') }}" width="110">
  <input id="coupon" placeholder="Enter Coupon Number">
  <button id="checkBtn" type="button">CHECK REWARD</button>

  <div id="reward" style="display:none">
    <p>You Have Won</p>
    <div class="amount">₹<span id="amount">0</span></div>
    <button id="claimBtn" type="button">CLAIM NOW</button>
  </div>

  <p id="status"></p>
</div>

<!-- POPUP -->
<div id="popup">
  <div class="party-popup">
    <div class="popup-grid">

      <!-- LEFT -->
      <div class="popup-left">
        <h2>🎉 Claim Your Prize 🎉</h2>

        <form method="POST" action="{{ route('reward.claim') }}" enctype="multipart/form-data">

            @csrf

          <div class="photo-row">
            <label class="photo-preview">
            <span class="placeholder">👤 Self Image</span>
            <input type="file" name="customer_photo" hidden>
            <img class="preview-img" style="display:none;">
            </label>


            <label class="photo-preview">
            <span class="placeholder">📦 Product Image</span>
            <input type="file" name="product_photo" hidden>
            <img class="preview-img" style="display:none;">
            </label>


          </div>

          <div class="field">
            <input id="full_name" name="full_name" placeholder="Full Name">
            <span class="tick" id="nameTick"></span>
          </div>

          <div class="field">
            <input id="phone_number" name="phone_number" placeholder="Phone Number">
            <span class="tick" id="phoneTick"></span>
          </div>

          <div class="field">
            <input id="email" name="email" placeholder="Email">
            <span class="tick" id="emailTick"></span>
          </div>

          <div class="field">
            <input id="upi" name="upi" placeholder="UPI ID">
            <span class="tick" id="upiTick"></span>
          </div>

          <div class="field">
            <input id="pin_code" name="pin_code" placeholder="Pin Code">
            <span class="tick" id="pinTick"></span>
          </div>

          <textarea id="address" readonly placeholder="Address"></textarea>
          <input name="product_name" placeholder="Product Name">
          <input name="coupon_code" id="coupon_auto" readonly>

          <button id="submitBtn" type="submit" >
  🎁 SUBMIT & CLAIM
</button>

          <p id="claimStatus"></p>
        </form>
      </div>

      <!-- RIGHT -->
      <div class="popup-right">
        <div class="disclaimer">
          <h3>⚠ Important Disclaimer</h3>
          <ul>
            <li>The name displayed on the UPI ID must exactly match the <b>Full Name</b> provided</li>
            <li>Providing incorrect or misleading details may result in cancellation of the reward</li>
            <li>Each coupon is valid for a single user and can be claimed only once</li>
            <li>Uploaded photos must be clear, original, and unedited</li>
            <li>Reward processing may take 3–5 working days after successful verification</li>
            <li>Claims will not be accepted after the campaign expiry date</li>
            <li>The company’s decision regarding reward eligibility and disbursement shall be final and binding</li>
          </ul>
        </div>

        @if(isset($campaign))
        @php
          $daysLeft = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($campaign->end_date), false);
        @endphp
        <div class="campaign-box">
          <h4>{{ $campaign->camp_name ?? 'Campaign' }}</h4>
          <p>{{ $campaign->start_date }} → {{ $campaign->end_date }}</p>
          <p class="blink">⏳ {{ $daysLeft }} Days Remaining</p>
        </div>
        @endif
      </div>

    </div>
  </div>
</div>
<div id="statusModal" style="display:none">
  <div class="status-card">
    <span class="close" onclick="closeStatus()">✖</span>

    <h2>🎁 Reward Status</h2>

    <div id="statusContent"></div>
  </div>
</div>
<script>
    function openStatus(code){
  fetch(`/reward/status/${code}`)
    .then(r=>r.json())
    .then(res=>{
      if(res.status !== 'success') return alert(res.message);

      const d = res.data;

      document.getElementById('statusContent').innerHTML = `
        <p><b>Name:</b> ${d.full_name}</p>
        <p><b>Phone:</b> ${d.phone_number}</p>
        <p><b>Email:</b> ${d.email}</p>
        <p><b>UPI:</b> ${d.upi}</p>
        <p><b>Amount:</b> ₹${d.amount}</p>
        <p><b>Status:</b> ${d.claim_status}</p>
        <p><b>Submitted:</b> ${d.created_at}</p>
        ${d.claim_status !== 'pending' ? `<p><b>Updated:</b> ${d.updated_at}</p>` : ''}

        ${d.customer_photo ? `<img src="${d.customer_photo}">` : ''}
        ${d.product_photo ? `<img src="${d.product_photo}">` : ''}
      `;

      document.getElementById('statusModal').style.display='flex';
    });
}

function closeStatus(){
  document.getElementById('statusModal').style.display='none';
}

</script>
<script>
/* CONFETTI */
const confettiBox=document.querySelector('.confetti-container');
for(let i=0;i<120;i++){
  const c=document.createElement('span');
  c.style.left=Math.random()*100+'%';
  c.style.background=['red','gold','yellow','blue','pink'][Math.floor(Math.random()*5)];
  c.style.animationDuration=(Math.random()*3+3)+'s';
  c.style.animationDelay=Math.random()*5+'s';
  confettiBox.appendChild(c);
}
</script>

<script>
/* VALIDATION */
const nameInput=document.getElementById('full_name');
const phoneInput=document.getElementById('phone_number');
const emailInput=document.getElementById('email');
const upiInput=document.getElementById('upi');
const pinInput=document.getElementById('pin_code');
const addressBox=document.getElementById('address');
const submitBtn=document.getElementById('submitBtn');

const nameTick=document.getElementById('nameTick');
const phoneTick=document.getElementById('phoneTick');
const emailTick=document.getElementById('emailTick');
const upiTick=document.getElementById('upiTick');
const pinTick=document.getElementById('pinTick');

function setTick(el,ok){
  el.textContent=ok?'✔':'✖';
  el.className='tick '+(ok?'ok':'bad');
}

nameInput.oninput=()=>{setTick(nameTick,nameInput.value.trim().length>=3);checkAll();}
phoneInput.oninput=()=>{phoneInput.value=phoneInput.value.replace(/\D/g,'');setTick(phoneTick,/^[6-9]\d{9}$/.test(phoneInput.value));checkAll();}
emailInput.oninput=()=>{setTick(emailTick,/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value));checkAll();}
upiInput.oninput=()=>{setTick(upiTick,/^[\w.\-]{2,}@[a-zA-Z]{2,}$/.test(upiInput.value));checkAll();}

pinInput.oninput=()=>{
  pinInput.value=pinInput.value.replace(/\D/g,'');
  if(pinInput.value.length===6){
    fetch(`https://api.postalpincode.in/pincode/${pinInput.value}`)
    .then(r=>r.json())
    .then(d=>{
      if(d[0].Status==='Success'){
        const p=d[0].PostOffice[0];
        addressBox.value=`${p.Name}, ${p.District}, ${p.State} - ${pinInput.value}`;
        setTick(pinTick,true);
      }else{addressBox.value='';setTick(pinTick,false);}
      checkAll();
    });
  }else{addressBox.value='';setTick(pinTick,false);checkAll();}
};

function checkAll(){
  submitBtn.disabled=!(
    nameTick.classList.contains('ok') &&
    phoneTick.classList.contains('ok') &&
    emailTick.classList.contains('ok') &&
    upiTick.classList.contains('ok') &&
    pinTick.classList.contains('ok')
  );
}
</script>

<script>
/* REWARD LOGIC */
const token=document.querySelector('meta[name="csrf-token"]').content;
const coupon=document.getElementById('coupon');
const reward=document.getElementById('reward');
const amount=document.getElementById('amount');
const statusBox=document.getElementById('status');
const popup=document.getElementById('popup');
const couponAuto=document.getElementById('coupon_auto');
const claimStatus=document.getElementById('claimStatus');
const claimForm=document.getElementById('claimForm');

document.querySelectorAll('input[type="file"]').forEach(input => {
  input.addEventListener('change', function () {

    const file = this.files[0];
    if (!file) return;

    const reader = new FileReader();
    const parent = this.parentElement;
    const img = parent.querySelector('.preview-img');
    const placeholder = parent.querySelector('.placeholder');

    reader.onload = function (e) {
      img.src = e.target.result;
      img.style.display = 'block';

      // 🔥 text + icon hata do
      if (placeholder) {
        placeholder.style.display = 'none';
      }
    };

    reader.readAsDataURL(file);
  });
});



checkBtn.onclick = () => {
  reward.style.display = 'none';
  statusBox.innerHTML = '';

  if (!coupon.value.trim()) {
    statusBox.innerText = 'Enter coupon number';
    return;
  }

  fetch(`/reward/check?code=${coupon.value}`)
    .then(r => r.json())
    .then(d => {

      // ❌ ERROR CASE
      if (d.status === 'error') {

        // 🔥 Already used case
        if (d.message && d.message.toLowerCase().includes('already')) {
          statusBox.innerHTML = `
            <div style="margin-top:10px">
              <p>${d.message}</p>
              <button
                onclick="openStatus('${coupon.value}')"
                style="
                  margin-top:12px;
                  padding:10px 18px;
                  border-radius:14px;
                  background:linear-gradient(135deg,gold,orange);
                  border:none;
                  font-weight:600;
                  cursor:pointer;
                ">
                🔍 Check Status
              </button>
            </div>
          `;
        }
        // ❌ Other errors (invalid / expired)
        else {
          statusBox.innerText = d.message;
        }

        return;
      }

      // ✅ SUCCESS CASE (reward available)
      amount.innerText = d.amount;
      reward.style.display = 'block';
    });
};


claimBtn.onclick=()=>{couponAuto.value=coupon.value;popup.style.display='block';}



</script>

</body>
</html>
