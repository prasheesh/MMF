@extends('layouts.app')
@section('style-content')
<style>
    .data{
          width: 600px;
          margin:0 auto;
          text-align: center;
          padding-top: 50px;
      }
        .content{
          max-width: 1000px;
          width: 100%;
          margin: 0 auto;
          padding: 30px;
          background: #fff;
          height: 90%;
          /*overflow: scroll;*/
          /*overflow-x: hidden;*/
      }
      .content::-webkit-scrollbar {
          width: 5px;
          height: 8px;
          background-color: #aaa; /* or add it to the track */
      }
      .content::-webkit-scrollbar-thumb {
          background: #000;
      }
      .content p{
          font-size: 14px;
          margin-bottom: 20px;
          text-align:justify;
      }

      .content  ul li{
          font-size: 14px;
          text-align:justify;
          margin-bottom: 10px;
      }
      .content ol li{
          font-size: 14px;
          text-align:justify;
          margin-bottom: 10px;
      }
</style>
@endsection

@section('content')
<div class="breadcrumbs aos-init aos-animate" data-aos="fade-in">
    <div class="container">
      <h2>Privacy Policy</h2>

    </div>
  </div>


  <div>

      <div class="content">

   <div class="text-end">
      <a href="{{ route('index') }}" style=""> <i class="fas fa-angle-double-left"></i>  Back to Home</a>
     </div>
      <p>This Privacy Policy describes the policies and procedures of Wing In MakeMyFly India Private Limited "MakeMyFly" on the collection, use, and disclosure of your information when you use the MakeMyFly Service, via the MakeMyFly website. MakeMyFly respects your privacy and is committed to protecting it through our accordance with the policy. Our website will be transparent about the information we collect and what we will do with it. We collect the information for enhancing your experience with MakeMyFly. We will also use the information which is collected by the website to provide you with better deals and offer.</p>
      <p>We will respect your data protection rights and aim to give you control over your own information. We have also given due consideration to technology advancement and legalities to come up with the following guidelines:</p>
      <p><b>Information we collect about you and how we collect it:</b>
      Our website collects various types of information about the clients that visit our website, but the information we collect is:</p>

      <ul class="list">
          <li>The data which is helps in identifying you personally like name, email, postal address, telephone number or any identifier which will help us to identify you or contact you online or offline.</li>
          <li>The data collected is about you but does not identify you.</li>
          <li>We also collect the data about your internet connection, the device you used to access our website and usage details.</li>
      </ul>

      <p>We also collect other information which allows us to make your next visit on our website better and helpful but not limited to passport, government-issued identification number, date of birth, gender, travel-related information.</p>

      <p><b>We only collect the information:</b></p>
      <ul class="list">
          <li>Which you provide us directly</li>
          <li>The website automatically navigates while you visit the website.</li>
          <li>From third parties</li>
      </ul>

      <p><b>The information you provide the website</b></p>
      <ul class="list">
          <li>Information that you fill up in the forms on the website.</li>
          <li>Records and copies of the correspondence</li>
          <li>Your response to the surveys that we asked for research purpose</li>
          <li>Details of the transactions you carry out through our website</li>
          <li>Your search queries</li>
      </ul>
      <p>If you download MakeMyFly’s Application, then the information that we will collect</p>

      <ul class="list">
          <li>Usage Details: If the client uses an application on the phone, the app automatically collects few details of the user including traffic data, location data, logs, and other communication data and the resources that you access and the use on or through our app.</li>
          <li>Device Information: We may collect information like IP dress, operating system, browser type, mobile network information, and the device’s telephone number.</li>
          <li>Stored Information and Files: Other information like photographs, audio, video, personal contact, and address book information is also accessed by our app</li>
      </ul>

      <h4>Client’s information</h4>
      <p>Details are collected when you visit our website and provide us with information. The automatic data collection technologies also work for collection of the data about your equipment, browsing actions and patterns.</p>
      <p><b>Via Cookies</b>: When anyone visits our website, the website automatically collects the data via cookies. Through cookies, we are able to track the personal detail on the customer’s computer that they have used to access our website. We are aware of the frequent visitors and we only collect the data to understand the client behavior and this helps in the improvement of the content or our website. Please refer to our Cookies Policy page for further details on this.</p>
      <p>Via Flash Cookies: certain features of the website may use locally stored objects which are known as Flash Cookies to collect and store the information about your preference and navigation. Via Web Beacons: The pages on our website and our e-mails may contain small electronic files which are known as web beacons which permit the Company to collect data like who has visited the page or opened the mail.</p>

      <p><b>How we use your information</b></p>
      <p>We only use the information which is provided to us by you,</p>

      <ul class="list">
          <li>To present our website and it’s content to you</li>
          <li>To fulfill your travel reservation and purchases</li>
          <li>To allow you to participate in the interactive feature on our website</li>
          <li>To promote our products and service</li>
      </ul>

      <p><b>Disclosure of your information</b></p>
      <p>We may disclose aggregated information about our clients and information that does not identify any individual, without restriction. We may only disclose personal data and information that we collect or the data that you have provided us with</p>
      <ul class="list">
          <li>To our subsidiaries and affiliates</li>
          <li>To the third-parties so that they can market their products or services to you</li>
          <li>To fulfill the purpose for which you provide the data with</li>
          <li>To enhance your next visit better on our website</li>
      </ul>

      <p>Choices About How We Use and Disclose Your Information<br>
          <b>Tracking technologies and advertising</b>: You can set your browsers or smartphones to refuse all or some of the browser or mobile cookies. You can choose to disable or refuse cookies or choose to alert you when cookies are being sent
      </p>
      <p>Disclosure of your information for Third-Party Advertising: You can always opt out by sending us a mail if you don’t want us to share your personal information with third-party.</p>

      <p>Targeted Advertising: You can always opt out by sending us a mail or unsubscribe if you don’t want us to use the information that we collect or that you may have provided us with to deliver advertisements.</p>

      <p>Promotional offers from the company: You can always opt out by sending a mail to us or unsubscribe to us if you don’t want to have your e-mail address/ contact information getting used by the company to promote our own or third parties’ product.</p>

      <p><b>Data Security</b></p>
      <p>We take the security of the data we collect or that you may have provided us with very seriously. We have implemented industry-standard measures designed to secure your personal information from accidental loss and from unauthorized access, use, alteration, and disclosure. Everything that you provide us with is secured behind firewalls.</p>
      <p>But we cannot guarantee or warrant the security of your personal information transmits to us online. Any transmission of the personal data you provide is at your own risk. All we can do is notify you via email if we learn that your personal information is compromised.</p>

      <p><b>Changes to our privacy policy</b></p>
      <p>Changes in our services or applicable laws and regulations and other reasons may require us to modify our privacy and data protection notices. MakeMyFly reserves the right to change the privacy policy at any time.</p>

<hr>


      <a href="{{ route('index') }}">  <i class="fas fa-angle-double-left"></i> Back to Home</a>



  </div>


  </div>

@endsection