<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="style2.css">
</head>
<body>
<section class="header">
        <nav>
            <img src="image/Eye.png"></a>
            <div class="logoName">
                <h1>Arise</h1>
            </div>
            </nav>
</section>

  <div class="container">
    <?php
    session_start();
    if(isset($_SESSION["user"])){
      header("Location: index.php");
      exit(); // Ensure script execution stops here if user is already logged in
    }

    if(isset($_POST["submit"])){
      $LastName = $_POST["Last_Name"];
      $FirstName = $_POST["First_Name"];
      $email = $_POST["Email"];
      $PhoneNumber = $_POST["Phone_Number"];
      $password = $_POST["password"];
      $RepeatPassword = $_POST["repeat_password"];
 
      $passwordHash = password_hash($password, PASSWORD_DEFAULT);
      $errors = array();
      if (empty($LastName) OR empty($FirstName) OR empty($email) OR empty($PhoneNumber) OR empty($password) OR empty($RepeatPassword)) {
        array_push($errors, "All fields are required");
      }
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors, "Email is not valid");
      }
      if (!filter_var($PhoneNumber, FILTER_VALIDATE_PHONE_NUMBER)){
        array_push($errors, "Phone Number is not valid");
      }
      if(strlen($password)<8) {
        array_push($errors, "Password must be at least 8 characters long");
      }
      if($password!= $RepeatPassword){
        array_push($errors, "Password does not match");
      }

      require_once "database.php";
      $sql = "SELECT * FROM user WHERE email = ?";
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "s", $email);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $rowCount = mysqli_num_rows($result);
      if ($rowCount>0) {
        array_push($errors, "Email Already Exist!");
      }
 
      if (count($errors)>0){
        foreach($errors as $error) {
          echo"<div class='alert alert-danger'>$error</div>";
        }
      } else {
        require_once "database.php";
        $sql = "INSERT INTO user(Last_Name, First_Name, email, Phone_Number, password) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        $preparestmt = mysqli_stmt_prepare($stmt, $sql);
        if ($preparestmt) {
          mysqli_stmt_bind_param($stmt, "ssss", $LastName, $FirstName, $email, $passwordHash);
          mysqli_stmt_execute($stmt);
          echo "<div class='alert alert-success'> You are Registered Successfully! </div>";
          // Store user's first name in session
          $_SESSION["user"] = "yes";
          $_SESSION["firstname"] = $FirstName;
          // Redirect to index.php
          header("Location: index.php");
          exit(); // Ensure script execution stops here
        } else {
          die("Something went wrong");
        }
      }
    }
    ?>

<h2>Create New Account</h2>
<form action="Registration2.php" method="post">
    <div class="form-group">
        <label for="LastName"></label>
        <p style="color: gold">Last Name:</p>
        <input type="text" class="form-control" name="LastName" required>
    </div>
    <div class="form-group">
        <label for="FirstName"></label>
        <p style="color: gold">First Name:</p>
        <input type="text" class="form-control" name="FirstName" required>
    </div>
    <div class="form-group">
        <label for="Email"></label>
        <p style="color: gold">Email:</p>
        <input type="email" class="form-control" name="Email" required>
    </div>
    <div class="form-group">
    <label for="PhoneNumber"></label>
    <p style="color: gold">Phone Number:</p>
    <div class="input-group">
        <select class="form-select" name="CountryCode" required>
            <option value="93">Afghanistan (AF / AFG) +93</option>
            <option value="355">Albania (AL / ALB) +355</option>
            <option value="213">Algeria (DZ / DZA) +213</option>
            <option value="1684">American Samoa (AS / ASM) +1 684</option>
            <option value="376">Andorra (AD / AND) +376</option>
            <option value="244">Angola (AO / AGO) +244</option>
            <option value="1264">Anguilla (AI / AIA) +1 264</option>
            <option value="672">Antarctica (AQ / ATA) +672</option>
            <option value="61">Australia (AU / AUS) +61</option>
            <option value="43">Austria (AT / AUT) +43</option>
            <option value="994">Azerbaijan (AZ / AZE) +994</option>
            <option value="1242">Bahamas (BS / BHS) +1 242</option>
            <option value="973">Bahrain (BH / BHR) +973</option>
            <option value="880">Bangladesh (BD / BGD) +880</option>
            <option value="1246">Barbados (BB / BRB) +1 246</option>
            <option value="375">Belarus (BY / BLR) +375</option>
            <option value="32">Belgium (BE / BEL) +32</option>
            <option value="501">Belize (BZ / BLZ) +501</option>
            <option value="229">Benin (BJ / BEN) +229</option>
            <option value="1441">Bermuda (BM / BMU) +1 441</option>
            <option value="975">Bhutan (BT / BTN) +975</option>
            <option value="591">Bolivia (BO / BOL) +591</option>
            <option value="387">Bosnia and Herzegovina (BA / BIH) +387</option>
            <option value="267">Botswana (BW / BWA) +267</option>
            <option value="55">Brazil (BR / BRA) +55</option>
            <option value="1284">British Virgin Islands (VG / VGB) +1 284</option>
            <option value="673">Brunei (BN / BRN) +673</option>
            <option value="359">Bulgaria (BG / BGR) +359</option>
            <option value="226">Burkina Faso (BF / BFA) +226</option>
            <option value="95">Burma (Myanmar) (MM / MMR) +95</option>
            <option value="257">Burundi (BI / BDI) +257</option>
            <option value="855">Cambodia (KH / KHM) +855</option>
            <option value="237">Cameroon (CM / CMR) +237</option>
            <option value="1">Canada (CA / CAN) +1</option>
            <option value="238">Cape Verde (CV / CPV) +238</option>
            <option value="1345">Cayman Islands (KY / CYM) +1 345</option>
            <option value="236">Central African Republic (CF / CAF) +236</option>
            <option value="235">Chad (TD / TCD) +235</option>
            <option value="56">Chile (CL / CHL) +56</option>
            <option value="86">China (CN / CHN) +86</option>
            <option value="61">Christmas Island (CX / CXR) +61</option>
            <option value="61">Cocos (Keeling) Islands (CC / CCK) +61</option>
            <option value="57">Colombia (CO / COL) +57</option>
            <option value="269">Comoros (KM / COM) +269</option>
            <option value="242">Congo (CG / COG) +242</option>
            <option value="682">Cook Islands (CK / COK) +682</option>
            <option value="506">Costa Rica (CR / CRC) +506</option>
            <option value="385">Croatia (HR / HRV) +385</option>
            <option value="53">Cuba (CU / CUB) +53</option>
            <option value="357">Cyprus (CY / CYP) +357</option>
            <option value="420">Czech Republic (CZ / CZE) +420</option>
            <option value="243">Democratic Republic of the Congo (CD / COD) +243</option>
            <option value="45">Denmark (DK / DNK) +45</option>
            <option value="246">Diego Garcia (DG/DGA) +246</option>
            <option value="253">Djibouti (DJ / DJI) +253</option>
            <option value="1767">Dominica (DM / DMA) +1 767</option>
            <option value="1809, 1829, 1849">Dominican Republic (DO / DOM) +1 809, +1 829, +1 849</option>
            <option value="593">Ecuador (EC / ECU) +593</option>
            <option value="20">Egypt (EG / EGY) +20</option>
            <option value="503">El Salvador (SV / SLV) +503</option>
            <option value="240">Equatorial Guinea (GQ / GNQ) +240</option>
            <option value="291">Eritrea (ER / ERI) +291</option>
            <option value="372">Estonia (EE / EST) +372</option>
            <option value="251">Ethiopia (ET / ETH) +251</option>
            <option value="500">Falkland Islands (FK / FLK) +500</option>
            <option value="298">Faroe Islands (FO / FRO) +298</option>
            <option value="679">Fiji (FJ / FJI) +679</option>
            <option value="358">Finland (FI / FIN) +358</option>
            <option value="33">France (FR / FRA) +33</option>
            <option value="594">French Guiana (GF / GUF) +594</option>
            <option value="689">French Polynesia (PF / PYF) +689</option>
            <option value="241">Gabon (GA / GAB) +241</option>
            <option value="220">Gambia (GM / GMB) +220</option>
            <option value="995">Georgia (GE / GEO) +995</option>
            <option value="49">Germany (DE / DEU) +49</option>
            <option value="233">Ghana (GH / GHA) +233</option>
            <option value="350">Gibraltar (GI / GIB) +350</option>
            <option value="30">Greece (GR / GRC) +30</option>
            <option value="299">Greenland (GL / GRL) +299</option>
            <option value="1473">Grenada (GD / GRD) +1 473</option>
            <option value="590">Guadeloupe (GP / GLP) +590</option>
            <option value="1671">Guam (GU / GUM) +1 671</option>
            <option value="502">Guatemala (GT / GTM) +502</option>
            <option value="224">Guinea (GN / GIN) +224</option>
            <option value="245">Guinea-Bissau (GW / GNB) +245</option>
            <option value="592">Guyana (GY / GUY) +592</option>
            <option value="509">Haiti (HT / HTI) +509</option>
            <option value="39">Holy See (Vatican City) (VA / VAT) +39</option>
            <option value="504">Honduras (HN / HND) +504</option>
            <option value="852">Hong Kong (HK / HKG) +852</option>
            <option value="36">Hungary (HU / HUN) +36</option>
            <option value="354">Iceland (IS / IS) +354</option>
            <option value="91">India (IN / IND) +91</option>
            <option value="62">Indonesia (ID / IDN) +62</option>
            <option value="98">Iran (IR / IRN) +98</option>
            <option value="964">Iraq (IQ / IRQ) +964</option>
            <option value="353">Ireland (IE / IRL) +353</option>
            <option value="44">Isle of Man (IM / IMN) +44</option>
            <option value="972">Israel (IL / ISR) +972</option>
            <option value="39">Italy (IT / ITA) +39</option>
            <option value="225">Ivory Coast (Côte d'Ivoire) (CI / CIV) +225</option>
            <option value="1876">Jamaica (JM / JAM) +1 876</option>
            <option value="81">Japan (JP / JPN) +81</option>
            <option value="44">Jersey (JE / JEY) +44</option>
            <option value="962">Jordan (JO / JOR) +962</option>
            <option value="7">Kazakhstan (KZ / KAZ) +7</option>
            <option value="254">Kenya (KE / KEN) +254</option>
            <option value="686">Kiribati (KI / KIR) +686</option>
            <option value="965">Kuwait (KW / KWT) +965</option>
            <option value="996">Kyrgyzstan (KG / KGZ) +996</option>
            <option value="856">Laos (LA / LAO) +856</option>
            <option value="371">Latvia (LV / LVA) +371</option>
            <option value="961">Lebanon (LB / LBN) +961</option>
            <option value="266">Lesotho (LS / LSO) +266</option>
            <option value="231">Liberia (LR / LBR) +231</option>
            <option value="218">Libya (LY / LBY) +218</option>
            <option value="423">Liechtenstein (LI / LIE) +423</option>
            <option value="370">Lithuania (LT / LTU) +370</option>
            <option value="352">Luxembourg (LU / LUX) +352</option>
            <option value="853">Macau (MO / MAC) +853</option>
            <option value="389">Macedonia (MK / MKD) +389</option>
            <option value="261">Madagascar (MG / MDG) +261</option>
            <option value="265">Malawi (MW / MWI) +265</option>
            <option value="60">Malaysia (MY / MYS) +60</option>
            <option value="960">Maldives (MV / MDV) +960</option>
            <option value="223">Mali (ML / MLI) +223</option>
            <option value="356">Malta (MT / MLT) +356</option>
            <option value="692">Marshall Islands (MH / MHL) +692</option>
            <option value="596">Martinique (MQ / MTQ) +596</option>
            <option value="222">Mauritania (MR / MRT) +222</option>
            <option value="230">Mauritius (MU / MUS) +230</option>
            <option value="262">Mayotte (YT / MYT) +262</option>
            <option value="52">Mexico (MX / MEX) +52</option>
            <option value="691">Micronesia (FM / FSM) +691</option>
            <option value="373">Moldova (MD / MDA) +373</option>
            <option value="377">Monaco (MC / MCO) +377</option>
            <option value="976">Mongolia (MN / MNG) +976</option>
            <option value="382">Montenegro (ME / MNE) +382</option>
            <option value="1664">Montserrat (MS / MSR) +1 664</option>
            <option value="212">Morocco (MA / MAR) +212</option>
            <option value="258">Mozambique (MZ / MOZ) +258</option>
            <option value="264">Namibia (NA / NAM) +264</option>
            <option value="674">Nauru (NR / NRU) +674</option>
            <option value="977">Nepal (NP / NPL) +977</option>
            <option value="31">Netherlands (NL / NLD) +31</option>
            <option value="599">Netherlands Antilles (AN / ANT) +599</option>
            <option value="687">New Caledonia (NC / NCL) +687</option>
            <option value="64">New Zealand (NZ / NZL) +64</option>
            <option value="505">Nicaragua (NI / NIC) +505</option>
            <option value="227">Niger (NE / NER) +227</option>
            <option value="234">Nigeria (NG / NGA) +234</option>
            <option value="683">Niue (NU / NIU) +683</option>
            <option value="672">Norfolk Island (NF / NFK) +672</option>
            <option value="850">North Korea (KP / PRK) +850</option>
            <option value="1670">Northern Mariana Islands (MP / MNP) +1 670</option>
            <option value="47">Norway (NO / NOR) +47</option>
            <option value="968">Oman (OM / OMN) +968</option>
            <option value="92">Pakistan (PK / PAK) +92</option>
            <option value="680">Palau (PW / PLW) +680</option>
            <option value="970">Palestine (PS / PSE) +970</option>
            <option value="507">Panama (PA / PAN) +507</option>
            <option value="675">Papua New Guinea (PG / PNG) +675</option>
            <option value="595">Paraguay (PY / PRY) +595</option>
            <option value="51">Peru (PE / PER) +51</option>
            <option value="63">Philippines (PH / PHL) +63</option>
            <option value="870">Pitcairn Islands (PN / PCN) +870</option>
            <option value="48">Poland (PL / POL) +48</option>
            <option value="351">Portugal (PT / PRT) +351</option>
            <option value="1787, 1939">Puerto Rico (PR / PRI) +1 787, +1 939</option>
            <option value="974">Qatar (QA / QAT) +974</option>
            <option value="242">Republic of the Congo (CG / COG) +242</option>
            <option value="262">Reunion Island (RE / REU) +262</option>
            <option value="40">Romania (RO / ROU) +40</option>
            <option value="7">Russia (RU / RUS) +7</option>
            <option value="250">Rwanda (RW / RWA) +250</option>
            <option value="590">Saint Barthelemy (BL / BLM) +590</option>
            <option value="290">Saint Helena (SH / SHN) +290</option>
            <option value="1869">Saint Kitts and Nevis (KN / KNA) +1 869</option>
            <option value="1758">Saint Lucia (LC / LCA) +1 758</option>
            <option value="590">Saint Martin (MF / MAF) +590</option>
            <option value="508">Saint Pierre and Miquelon (PM / SPM) +508</option>
            <option value="1784">Saint Vincent and the Grenadines (VC / VCT) +1 784</option>
            <option value="685">Samoa (WS / WSM) +685</option>
            <option value="378">San Marino (SM / SMR) +378</option>
            <option value="239">Sao Tome and Principe (ST / STP) +239</option>
            <option value="966">Saudi Arabia (SA / SAU) +966</option>
            <option value="221">Senegal (SN / SEN) +221</option>
            <option value="381">Serbia (RS / SRB) +381</option>
            <option value="248">Seychelles (SC / SYC) +248</option>
            <option value="232">Sierra Leone (SL / SLE) +232</option>
            <option value="65">Singapore (SG / SGP) +65</option>
            <option value="1721">Sint Maarten (SX / SXM) +1 721</option>
            <option value="421">Slovakia (SK / SVK) +421</option>
            <option value="386">Slovenia (SI / SVN) +386</option>
            <option value="677">Solomon Islands (SB / SLB) +677</option>
            <option value="252">Somalia (SO / SOM) +252</option>
            <option value="27">South Africa (ZA / ZAF) +27</option>
            <option value="82">South Korea (KR / KOR) +82</option>
            <option value="211">South Sudan (SS / SSD) +211</option>
            <option value="34">Spain (ES / ESP) +34</option>
            <option value="94">Sri Lanka (LK / LKA) +94</option>
            <option value="249">Sudan (SD / SDN) +249</option>
            <option value="597">Suriname (SR / SUR) +597</option>
            <option value="47">Svalbard (SJ / SJM) +47</option>
            <option value="268">Swaziland (SZ / SWZ) +268</option>
            <option value="46">Sweden (SE / SWE) +46</option>
            <option value="41">Switzerland (CH / CHE) +41</option>
            <option value="963">Syria (SY / SYR) +963</option>
            <option value="886">Taiwan (TW / TWN) +886</option>
            <option value="992">Tajikistan (TJ / TJK) +992</option>
            <option value="255">Tanzania (TZ / TZA) +255</option>
            <option value="66">Thailand (TH / THA) +66</option>
            <option value="670">Timor-Leste (East Timor) (TL / TLS) +670</option>
            <option value="228">Togo (TG / TGO) +228</option>
            <option value="690">Tokelau (TK / TKL) +690</option>
            <option value="676">Tonga Islands (TO / TON) +676</option>
            <option value="1868">Trinidad and Tobago (TT / TTO) +1 868</option>
            <option value="216">Tunisia (TN / TUN) +216</option>
            <option value="90">Turkey (TR / TUR) +90</option>
            <option value="993">Turkmenistan (TM / TKM) +993</option>
            <option value="1649">Turks and Caicos Islands (TC / TCA) +1 649</option>
            <option value="688">Tuvalu (TV / TUV) +688</option>
            <option value="256">Uganda (UG / UGA) +256</option>
            <option value="380">Ukraine (UA / UKR) +380</option>
            <option value="971">United Arab Emirates (AE / ARE) +971</option>
            <option value="44">United Kingdom (GB / GBR) +44</option>
            <option value="1">United States (US / USA) +1</option>
            <option value="598">Uruguay (UY / URY) +598</option>
            <option value="1340">US Virgin Islands (VI / VIR) +1 340</option>
            <option value="998">Uzbekistan (UZ / UZB) +998</option>
            <option value="678">Vanuatu (VU / VUT) +678</option>
            <option value="58">Venezuela (VE / VEN) +58</option>
            <option value="84">Vietnam (VN / VNM) +84</option>
            <option value="681">Wallis and Futuna (WF / WLF) +681</option>
            <option value="212">Western Sahara (EH / ESH) +212</option>
            <option value="967">Yemen (YE / YEM) +967</option>
            <option value="260">Zambia (ZM / ZMB) +260</option>
            <option value="263">Zimbabwe (ZW / ZWE) +263</option>
            </select>
            <input type="tel" class="form-control" name="PhoneNumber" id="phoneNumberInput" maxlength="10" pattern="\d{1,9}">
    </div>
</div>
    <div class="form-group">
        <label for="Password"></label>
        <p style="color: gold">Password:</p>
        <input type="password" class="form-control" name="password" required>
    </div>
    <div class="form-group">
        <label for="Repeat_Password"></label>
        <p style="color: gold">Repeat Password:</p>
        <input type="password" class="form-control" name="repeat_password" required>
    </div>
    <div>
        <p style="color: gold">Already registered? <a href="login.php"> Login Here</a></p>
    </div>
    <div class="form-btn">
    <a href="Login.php" class="hero-btn">Back</a> <input type="Submit" class="hero-btn" value="Next" name="Submit">
    </div>
</form>
  <script>
    document.getElementById("Registration").addEventListener("Next", function(event) {
      var lastName = document.getElementById("LastName").value.trim();
      var firstName = document.getElementById("FirstName").value.trim();
      var email = document.getElementById("Email").value.trim();
      var password = document.getElementById("password").value;
      var repeatPassword = document.getElementById("repeat_password").value;

      if (lastName === "" || firstName === "" || email === "" || password === "" || repeatPassword === "") {
        alert("All fields are required");
        event.preventDefault();
        return;
      }

      if (!validateEmail(email)) {
        alert("Email is not valid");
        event.preventDefault();
        return;
      }

      if (password.length < 8) {
        alert("Password must be at least 8 characters long");
        event.preventDefault();
        return;
      }

      if (password !== repeatPassword) {
        alert("Passwords do not match");
        event.preventDefault();
        return;
      }


    });

    function validateEmail(email) {
      var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return re.test(email);
    }
  </script>
</body>
</html>
