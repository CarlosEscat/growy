@extends('layouts.front')
@section ('content')

<div class='astronaut'>
  <!-- <img src='../images/Astronaut.png' alt='Astronaut' class='astronaut2'> -->
  <div class='titleText'>
    <h1>Welcome to Growyspace</h1>
    <p class='textTitle'>Register below to find your next<br> opportunity or create one!</p>
    <br><br><button class='register' onclick="location.href='/user/register'">Register here</button> &nbsp<label class='or'>or</label>&nbsp <button class='loginButton' onclick="location.href='/user/login'">Login</button>
 </div>
</div>

<div class='explore'>
  <div class='circle'>
    <h2 class='exploreTitle'>Explore Growyspace</h2>
    <p class='exploreText'>We are a professional development<br>
    platform that bridges Opportunities <br>
    with Open-to-work requests from <br>
    individual professionals. <a href="">Try it now</a></p>
  </div>
  <img src='/assets/images/icon-search-big.png' alt='Search' class='imageSearch'>
</div>

<div class='options'>
  <h2 class='looking'>What are you looking for?</h2>
  <button type="button" class='opportunityButton' onclick="location.href='#opportunitySeekers'">I'm looking for opportunities</button><br><br>
  <button class='talentButton' onclick="location.href='#talentSeekers'">I'm looking for talents</button>
</div>



<div class='opportunity' id='opportunitySeekers'>
  <h2 class='seekers'>Growyspace for opportunity seekers</h2>
  <ul>
    <li>1) Create an Open-to-work card, and fill out your areas of interest, presentation letter, past experience, skills or education.</li>
    <li>2) Share your Open-to-work card through the chat function or external, so to gain endorsements of your skills.</li>
    <li>3) Send your Open-to-work card to the available Opportunities, or other relevant users.</li>
    <li>4) Explore the available Opportunities, registered users, or available Open-to-work cards.</li>
    <li>5) Create and manage a collection or portfolio of either available Opportunities, Open-to-work, or users.</li>
  </ul>
  <label class='getStarted'>Get started looking for opportunities by signing up!</label>
  <p class='line'><button class='signupButton' onclick="location.href='/user/register'">Sign up</button></p>
</div>

<div class='mission'>
  <div class='star'></div>
  <div class='missionText'>
  <h2 class='missionTitle'>Growyspace’s mission</h2>
  <p class='missionP'>Tech is our tool, and to promote individual professional growth is our mission.</p>
  </div>
</div>

<div class='talent' id='talentSeekers'>
  <h2 class='seekers'>Growyspace for talent seekers</h2>
  <ul>
    <li>1) Create an Opportunity card and fill out the relevant details such as location, fields (skills required), and the discription of the opportunity</li>
    <li>2) Share your created Opportunity card through the chat function or external, so to gain trafic and exposure</li>
    <li>3) Send your Opportunity card to the available Open-to-work cards created by opportunity seeking profesionals</li>
    <li>4) Explore the available Open-to-work cards, registered users, or available Opportunities </li>
    <li>5) Create and manage a collection or portfolio of either available Open-to-work, users, or other Opportunities.</li>
  </ul>
  <label class='getStarted'>Find great talents by signing up!</label>
  <p class='line'><button class='signupButtonTalent' onclick="location.href='/user/register'">Sign up</button></p>
</div>

<div class='contact'>
  <div class='contactText'>
    <h2 class='contactTitle'>Contact us</h2>
    <p class='contactPText'>Contact a member of Growyspace if you have any inquiries. 
    <a href="">Contact us</a></p>
  </div>
  <div class='imageDiv'>
    <img src='/assets/images/icon-message-big.png' alt='Message' class='imageMessage'>
  </div>
</div>

@endsection 
