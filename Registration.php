<?php
    session_start();
    if(isset($_SESSION["user"])){
        header("Location: index.php");
    }
?> 

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
    if(isset($_POST["submit"])){
        $LastName = $_POST["LastName"];
        $FirstName = $_POST["FirstName"];
        $email = $_POST["Email"];
        $password = $_POST["password"];
        $RepeatPassword = $_POST["repeat_password"];

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $errors = array();
        if (empty($LastName) || empty($FirstName) || empty($email) || empty($password) || empty($RepeatPassword)) {
            array_push($errors, "All fields are required");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($errors, "Email is not valid");
        }
        if(strlen($password) < 8) {
            array_push($errors, "Password must be at least 8 characters long");
        }
        if($password != $RepeatPassword){
            array_push($errors, "Password does not match");
        }

        require_once "database.php";
        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount > 0) {
                array_push($errors, "Email Already Exists!");
            }
        }

        if (count($errors) > 0) {
            foreach($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {
            require_once "database.php";
            $sql = "INSERT INTO user(LastName, FirstName, email, password) VALUES (?, ?, ?, ?, )";
            $stmt = mysqli_stmt_init($conn);
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "sssss", $LastName, $FirstName, $email, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'> You are Registered Successfully! </div>";
            } else {
                die("Something went wrong");
            }
        }
    }
?>


<h2>Create New Account</h2>
<form action="index.php" method="post">
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
    <label for="Number"></label>
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
            <input type="tel" class="form-control" name="number" id="Number" maxlength="10" pattern="\d{1,10}">
    </div>
</div>
<div class="form-group">
        <label for="Lot/Blk"></label>
        <p style="color: gold">Lot/Blk:</p>
        <input type="text" class="form-control" name="Lot/Blk" required>
    </div>
    <div class="form-group">
        <label for="street"></label>
        <p style="color: gold">Street:</p>
        <input type="text" class="form-control" name="street" required>
    </div>
    <div class="form-group">
        <label for="subdivision"></label>
        <p style="color: gold">Subdivision:</p>
        <input type="text" class="form-control" name="subdivision" required>
    </div>
    <div class="form-group">
    <label for=barangay"></label>
    <p style="color: gold">Barangay:</p>
    <input type="text" class="form-control" name="barangay" required>
</div>
<div class="form-group">
    <label for="city"></label>
    <p style="color: gold">City:</p>        <div class="input-group">
    <select class="form-select" name="city" required>
    <option value="Angeles">Angeles</option>
<option value="Bacolod">Bacolod</option>
<option value="Baguio">Baguio</option>
<option value="Butuan">Butuan</option>
<option value="Cagayan de Oro">Cagayan de Oro</option>
<option value="Caloocan">Caloocan</option>
<option value="Cebu City">Cebu City</option>
<option value="Davao City">Davao City</option>
<option value="General Santos">General Santos</option>
<option value="Iligan">Iligan</option>
<option value="Iloilo City">Iloilo City</option>
<option value="Lapu-Lapu">Lapu-Lapu</option>
<option value="Las Piñas">Las Piñas</option>
<option value="Lucena">Lucena</option>
<option value="Makati">Makati</option>
<option value="Malabon">Malabon</option>
<option value="Mandaluyong">Mandaluyong</option>
<option value="Mandaue">Mandaue</option>
<option value="Manila">Manila</option>
<option value="Marikina">Marikina</option>
<option value="Muntinlupa">Muntinlupa</option>
<option value="Navotas">Navotas</option>
<option value="Olongapo">Olongapo</option>
<option value="Parañaque">Parañaque</option>
<option value="Pasay">Pasay</option>
<option value="Pasig">Pasig</option>
<option value="Puerto Princesa">Puerto Princesa</option>
<option value="Quezon City">Quezon City</option>
<option value="San Juan">San Juan</option>
<option value="Tacloban">Tacloban</option>
<option value="Taguig">Taguig</option>
<option value="Valenzuela">Valenzuela</option>
<option value="Zamboanga City">Zamboanga City</option>
<option value="Cotabato City">Cotabato City</option>
<option value="Dagupan (Pangasinan)">Dagupan (Pangasinan)</option>
<option value="Naga (Camarines Sur)">Naga (Camarines Sur)</option>
<option value="Ormoc (Leyte)">Ormoc (Leyte)</option>
<option value="Santiago (Isabela)">Santiago (Isabela)</option>
<option value="Alaminos (Pangasinan)">Alaminos (Pangasinan)</option>
<option value="Antipolo (Rizal)">Antipolo (Rizal)</option>
<option value="Bacoor (Cavite)">Bacoor (Cavite)</option>
<option value="Bago (Negros Occidental)">Bago (Negros Occidental)</option>
<option value="Bais (Negros Oriental)">Bais (Negros Oriental)</option>
<option value="Balanga (Bataan)">Balanga (Bataan)</option>
<option value="Batac (Ilocos Norte)">Batac (Ilocos Norte)</option>
<option value="Batangas City (Batangas)">Batangas City (Batangas)</option>
<option value="Bayawan (Negros Oriental)">Bayawan (Negros Oriental)</option>
<option value="Baybay (Leyte)">Baybay (Leyte)</option>
<option value="Bayugan (Agusan del Sur)">Bayugan (Agusan del Sur)</option>
<option value="Bislig (Surigao del Sur)">Bislig (Surigao del Sur)</option>
<option value="Biñan (Laguna)">Biñan (Laguna)</option>
<option value="Bogo (Cebu)">Bogo (Cebu)</option>
<option value="Borongan (Eastern Samar)">Borongan (Eastern Samar)</option>
<option value="Cabadbaran (Agusan del Norte)">Cabadbaran (Agusan del Norte)</option>
<option value="Cabanatuan (Nueva Ecija)">Cabanatuan (Nueva Ecija)</option>
<option value="Cabuyao (Laguna)">Cabuyao (Laguna)</option>
<option value="Cadiz (Negros Occidental)">Cadiz (Negros Occidental)</option>
<option value="Calamba (Laguna)">Calamba (Laguna)</option>
<option value="Calapan (Oriental Mindoro)">Calapan (Oriental Mindoro)</option>
<option value="Calbayog (Samar)">Calbayog (Samar)</option>
<option value="Candon (Ilocos Sur)">Candon (Ilocos Sur)</option>
<option value="Canlaon (Negros Oriental)">Canlaon (Negros Oriental)</option>
<option value="Carcar (Cebu)">Carcar (Cebu)</option>
<option value="Catbalogan (Samar)">Catbalogan (Samar)</option>
<option value="Cauayan (Isabela)">Cauayan (Isabela)</option>
<option value="Cavite City (Cavite)">Cavite City (Cavite)</option>
<option value="Danao (Cebu)">Danao (Cebu)</option>
<option value="Dapitan (Zamboanga del Norte)">Dapitan (Zamboanga del Norte)</option>
<option value="Dasmariñas (Cavite)">Dasmariñas (Cavite)</option>
<option value="Digos (Davao del Sur)">Digos (Davao del Sur)</option>
<option value="Dipolog (Zamboanga del Norte)">Dipolog (Zamboanga del Norte)</option>
<option value="Dumaguete (Negros Oriental)">Dumaguete (Negros Oriental)</option>
<option value="El Salvador (Misamis Oriental)">El Salvador (Misamis Oriental)</option>
<option value="Escalante (Negros Occidental)">Escalante (Negros Occidental)</option>
<option value="Gapan (Nueva Ecija)">Gapan (Nueva Ecija)</option>
<option value="General Trias (Cavite)">General Trias (Cavite)</option>
<option value="Gingoog (Misamis Oriental)">Gingoog (Misamis Oriental)</option>
<option value="Guihulngan (Negros Oriental)">Guihulngan (Negros Oriental)</option>
<option value="Himamaylan (Negros Occidental)">Himamaylan (Negros Occidental)</option>
<option value="Ilagan (Isabela)">Ilagan (Isabela)</option>
<option value="Imus (Cavite)">Imus (Cavite)</option>
<option value="Iriga (Camarines Sur)">Iriga (Camarines Sur)</option>
<option value="Isabela City (Basilan)">Isabela City (Basilan)</option>
<option value="Kabankalan (Negros Occidental)">Kabankalan (Negros Occidental)</option>
<option value="Kidapawan (Cotabato)">Kidapawan (Cotabato)</option>
<option value="Koronadal (South Cotabato)">Koronadal (South Cotabato)</option>
<option value="La Carlota (Negros Occidental)">La Carlota (Negros Occidental)</option>
<option value="Lamitan (Basilan)">Lamitan (Basilan)</option>
<option value="Laoag (Ilocos Norte)">Laoag (Ilocos Norte)</option>
<option value="Legazpi (Albay)">Legazpi (Albay)</option>
<option value="Ligao (Albay)">Ligao (Albay)</option>
<option value="Lipa (Batangas)">Lipa (Batangas)</option>
<option value="Maasin (Southern Leyte)">Maasin (Southern Leyte)</option>
<option value="Mabalacat (Pampanga)">Mabalacat (Pampanga)</option>
<option value="Malaybalay (Bukidnon)">Malaybalay (Bukidnon)</option>
<option value="Malolos (Bulacan)">Malolos (Bulacan)</option>
<option value="Marawi (Lanao del Sur)">Marawi (Lanao del Sur)</option>
<option value="Masbate City (Masbate)">Masbate City (Masbate)</option>
<option value="Mati (Davao Oriental)">Mati (Davao Oriental)</option>
<option value="Meycauayan (Bulacan)">Meycauayan (Bulacan)</option>
<option value="Muñoz (Nueva Ecija)">Muñoz (Nueva Ecija)</option>
<option value="Naga (Cebu)">Naga (Cebu)</option>
<option value="Oroquieta (Misamis Occidental)">Oroquieta (Misamis Occidental)</option>
<option value="Ozamiz (Misamis Occidental)">Ozamiz (Misamis Occidental)</option>
<option value="Pagadian (Zamboanga del Sur)">Pagadian (Zamboanga del Sur)</option>
<option value="Palayan (Nueva Ecija)">Palayan (Nueva Ecija)</option>
<option value="Panabo (Davao del Norte)">Panabo (Davao del Norte)</option>
<option value="Passi (Iloilo)">Passi (Iloilo)</option>
<option value="Roxas City (Capiz)">Roxas City (Capiz)</option>
<option value="Sagay (Negros Occidental)">Sagay (Negros Occidental)</option>
<option value="Samal (Davao del Norte)">Samal (Davao del Norte)</option>
<option value="San Carlos (Pangasinan)">San Carlos (Pangasinan)</option>
<option value="San Carlos (Negros Occidental)">San Carlos (Negros Occidental)</option>
<option value="San Fernando (La Union)">San Fernando (La Union)</option>
<option value="San Fernando (Pampanga)">San Fernando (Pampanga)</option>
<option value="San Jose (Nueva Ecija)">San Jose (Nueva Ecija)</option>
<option value="San Jose del Monte (Bulacan)">San Jose del Monte (Bulacan)</option>
<option value="San Pablo (Laguna)">San Pablo (Laguna)</option>
<option value="San Pedro (Laguna)">San Pedro (Laguna)</option>
<option value="Santa Rosa (Laguna)">Santa Rosa (Laguna)</option>
<option value="Santo Tomas (Batangas)">Santo Tomas (Batangas)</option>
<option value="Silay (Negros Occidental)">Silay (Negros Occidental)</option>
<option value="Sipalay (Negros Occidental)">Sipalay (Negros Occidental)</option>
<option value="Sorsogon City (Sorsogon)">Sorsogon City (Sorsogon)</option>
<option value="Surigao City (Surigao del Norte)">Surigao City (Surigao del Norte)</option>
<option value="Tabaco (Albay)">Tabaco (Albay)</option>
<option value="Tabuk (Kalinga)">Tabuk (Kalinga)</option>
<option value="Tacurong (Sultan Kudarat)">Tacurong (Sultan Kudarat)</option>
<option value="Tagaytay (Cavite)">Tagaytay (Cavite)</option>
<option value="Tagbilaran (Bohol)">Tagbilaran (Bohol)</option>
<option value="Tagum (Davao del Norte)">Tagum (Davao del Norte)</option>
<option value="Talisay (Negros Occidental)">Talisay (Negros Occidental)</option>
<option value="Talisay (Cebu)">Talisay (Cebu)</option>
<option value="Tanauan (Batangas)">Tanauan (Batangas)</option>
<option value="Tandag (Surigao del Sur)">Tandag (Surigao del Sur)</option>
<option value="Tangub (Misamis Occidental)">Tangub (Misamis Occidental)</option>
<option value="Tanjay (Negros Oriental)">Tanjay (Negros Oriental)</option>
<option value="Tarlac City (Tarlac)">Tarlac City (Tarlac)</option>
<option value="Tayabas (Quezon)">Tayabas (Quezon)</option>
<option value="Toledo (Cebu)">Toledo (Cebu)</option>
<option value="Trece Martires (Cavite)">Trece Martires (Cavite)</option>
<option value="Tuguegarao (Cagayan)">Tuguegarao (Cagayan)</option>
<option value="Urdaneta (Pangasinan)">Urdaneta (Pangasinan)</option>
<option value="Valencia (Bukidnon)">Valencia (Bukidnon)</option>
<option value="Victorias (Negros Occidental)">Victorias (Negros Occidental)</option>
<option value="Vigan (Ilocos Sur)">Vigan (Ilocos Sur)</option>
</select>
    </div>
    <div class="form-group">
    <label for="province"></label>
    <p style="color: gold">Province:</p>        <div class="input-group">
    <select class="form-select" name="province" required>
    <option value="Abra">Abra</option>
<option value="Agusan del Norte">Agusan del Norte</option>
<option value="Agusan del Sur">Agusan del Sur</option>
<option value="Aklan">Aklan</option>
<option value="Albay">Albay</option>
<option value="Antique">Antique</option>
<option value="Apayao">Apayao</option>
<option value="Aurora">Aurora</option>
<option value="Basilan">Basilan</option>
<option value="Bataan">Bataan</option>
<option value="Batanes">Batanes</option>
<option value="Batangas">Batangas</option>
<option value="Benguet">Benguet</option>
<option value="Biliran">Biliran</option>
<option value="Bohol">Bohol</option>
<option value="Bukidnon">Bukidnon</option>
<option value="Bulacan">Bulacan</option>
<option value="Cagayan">Cagayan</option>
<option value="Camarines Norte">Camarines Norte</option>
<option value="Camarines Sur">Camarines Sur</option>
<option value="Camiguin">Camiguin</option>
<option value="Capiz">Capiz</option>
<option value="Catanduanes">Catanduanes</option>
<option value="Cavite">Cavite</option>
<option value="Cebu">Cebu</option>
<option value="Cotabato">Cotabato</option>
<option value="Davao de Oro (Compostela Valley)">Davao de Oro (Compostela Valley)</option>
<option value="Davao del Norte">Davao del Norte</option>
<option value="Davao del Sur">Davao del Sur</option>
<option value="Davao Occidental">Davao Occidental</option>
<option value="Davao Oriental">Davao Oriental</option>
<option value="Dinagat Islands">Dinagat Islands</option>
<option value="Eastern Samar">Eastern Samar</option>
<option value="Guimaras">Guimaras</option>
<option value="Ifugao">Ifugao</option>
<option value="Ilocos Norte">Ilocos Norte</option>
<option value="Ilocos Sur">Ilocos Sur</option>
<option value="Iloilo">Iloilo</option>
<option value="Isabela">Isabela</option>
<option value="Kalinga">Kalinga</option>
<option value="Laguna">Laguna</option>
<option value="Lanao del Norte">Lanao del Norte</option>
<option value="Lanao del Sur">Lanao del Sur</option>
<option value="La Union">La Union</option>
<option value="Leyte">Leyte</option>
<option value="Maguindanao">Maguindanao</option>
<option value="Marinduque">Marinduque</option>
<option value="Masbate">Masbate</option>
<option value="Misamis Occidental">Misamis Occidental</option>
<option value="Misamis Oriental">Misamis Oriental</option>
<option value="Mountain Province">Mountain Province</option>
<option value="Negros Occidental">Negros Occidental</option>
<option value="Negros Oriental">Negros Oriental</option>
<option value="Northern Samar">Northern Samar</option>
<option value="Nueva Ecija">Nueva Ecija</option>
<option value="Nueva Vizcaya">Nueva Vizcaya</option>
<option value="Occidental Mindoro">Occidental Mindoro</option>
<option value="Oriental Mindoro">Oriental Mindoro</option>
<option value="Palawan">Palawan</option>
<option value="Pampanga">Pampanga</option>
<option value="Pangasinan">Pangasinan</option>
<option value="Quezon">Quezon</option>
<option value="Quirino">Quirino</option>
<option value="Rizal">Rizal</option>
<option value="Romblon">Romblon</option>
<option value="Samar">Samar</option>
<option value="Sarangani">Sarangani</option>
<option value="Siquijor">Siquijor</option>
<option value="Sorsogon">Sorsogon</option>
<option value="South Cotabato">South Cotabato</option>
<option value="Southern Leyte">Southern Leyte</option>
<option value="Sultan Kudarat">Sultan Kudarat</option>
<option value="Sulu">Sulu</option>
<option value="Surigao del Norte">Surigao del Norte</option>
<option value="Surigao del Sur">Surigao del Sur</option>
<option value="Tarlac">Tarlac</option>
<option value="Tawi-Tawi">Tawi-Tawi</option>
<option value="Zambales">Zambales</option>
<option value="Zamboanga del Norte">Zamboanga del Norte</option>
<option value="Zamboanga del Sur">Zamboanga del Sur</option>
<option value="Zamboanga Sibugay">Zamboanga Sibugay</option>
<option value="National Capital Region (NCR)">National Capital Region (NCR)</option>
<option value="Highly urbanized cities outside NCR, and Cotabato City">Highly urbanized cities outside NCR, and Cotabato City</option>
</select>
    </div>
    <div class="form-group">
    <label for="country"></label>
    <p style="color: gold">Country:</p>        <div class="input-group">
    <select class="form-select" name="country" required>
        <option value="Afghanistan">Afghanistan (AF / AFG)</option>
        <option value="Albania">Albania (AL / ALB)</option>
        <option value="Algeria">Algeria (DZ / DZA)</option>
        <option value="American Samoa">American Samoa (AS / ASM)</option>
        <option value="Andorra">Andorra (AD / AND)</option>
        <option value="Angola">Angola (AO / AGO)</option>
        <option value="Anguilla">Anguilla (AI / AIA)</option>
        <option value="Antarctica">Antarctica (AQ / ATA)</option>
        <option value="Australia">Australia (AU / AUS)</option>
        <option value="Austria">Austria (AT / AUT)</option>
        <option value="Azerbaijan">Azerbaijan (AZ / AZE)</option>
        <option value="Bahamas">Bahamas (BS / BHS)</option>
        <option value="Bahrain">Bahrain (BH / BHR)</option>
        <option value="Bangladesh">Bangladesh (BD / BGD)</option>
        <option value="Barbados">Barbados (BB / BRB)</option>
        <option value="Belarus">Belarus (BY / BLR)</option>
        <option value="Belgium">Belgium (BE / BEL)</option>
        <option value="Belize">Belize (BZ / BLZ)</option>
        <option value="Benin">Benin (BJ / BEN)</option>
        <option value="Bermuda">Bermuda (BM / BMU)</option>
        <option value="Bhutan">Bhutan (BT / BTN)</option>
        <option value="Bolivia">Bolivia (BO / BOL)</option>
        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina (BA / BIH)</option>
        <option value="Botswana">Botswana (BW / BWA)</option>
        <option value="Brazil">Brazil (BR / BRA)</option>
        <option value="British Virgin Islands">British Virgin Islands (VG / VGB)</option>
        <option value="Brunei">Brunei (BN / BRN)</option>
        <option value="Bulgaria">Bulgaria (BG / BGR)</option>
        <option value="Burkina Faso">Burkina Faso (BF / BFA)</option>
        <option value="Burma (Myanmar)">Burma (Myanmar) (MM / MMR)</option>
        <option value="Burundi">Burundi (BI / BDI)</option>
        <option value="Cambodia">Cambodia (KH / KHM)</option>
        <option value="Cameroon">Cameroon (CM / CMR)</option>
        <option value="Canada">Canada (CA / CAN)</option>
        <option value="Cape Verde">Cape Verde (CV / CPV)</option>
        <option value="Cayman Islands">Cayman Islands (KY / CYM)</option>
        <option value="Central African Republic">Central African Republic (CF / CAF)</option>
        <option value="Chad">Chad (TD / TCD)</option>
        <option value="Chile">Chile (CL / CHL)</option>
        <option value="China">China (CN / CHN)</option>
        <option value="Christmas Island">Christmas Island (CX / CXR)</option>
        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands (CC / CCK)</option>
        <option value="Colombia">Colombia (CO / COL)</option>
        <option value="Comoros">Comoros (KM / COM)</option>
        <option value="Congo">Congo (CG / COG)</option>
        <option value="Cook Islands">Cook Islands (CK / COK)</option>
        <option value="Costa Rica">Costa Rica (CR / CRC)</option>
        <option value="Croatia">Croatia (HR / HRV)</option>
        <option value="Cuba">Cuba (CU / CUB)</option>
        <option value="Cyprus">Cyprus (CY / CYP)</option>
        <option value="Czech Republic">Czech Republic (CZ / CZE)</option>
        <option value="Democratic Republic of the Congo">Democratic Republic of the Congo (CD / COD)</option>
        <option value="Denmark">Denmark (DK / DNK)</option>
        <option value="Diego Garcia">Diego Garcia (DG/DGA)</option>
        <option value="Djibouti">Djibouti (DJ / DJI)</option>
        <option value="Dominica">Dominica (DM / DMA)</option>
        <option value="Dominican Republic">Dominican Republic (DO / DOM)</option>
        <option value="Ecuador">Ecuador (EC / ECU)</option>
        <option value="Egypt">Egypt (EG / EGY)</option>
        <option value="El Salvador">El Salvador (SV / SLV)</option>
        <option value="Equatorial Guinea">Equatorial Guinea (GQ / GNQ)</option>
        <option value="Eritrea">Eritrea (ER / ERI)</option>
        <option value="Estonia">Estonia (EE / EST)</option>
        <option value="Ethiopia">Ethiopia (ET / ETH)</option>
        <option value="Falkland Islands">Falkland Islands (FK / FLK)</option>
        <option value="Faroe Islands">Faroe Islands (FO / FRO)</option>
        <option value="Fiji">Fiji (FJ / FJI)</option>
        <option value="Finland">Finland (FI / FIN)</option>
        <option value="France">France (FR / FRA)</option>
        <option value="French Guiana">French Guiana (GF / GUF)</option>
        <option value="French Polynesia">French Polynesia (PF / PYF)</option>
        <option value="Gabon">Gabon (GA / GAB)</option>
        <option value="Gambia">Gambia (GM / GMB)</option>
        <option value="Georgia">Georgia (GE / GEO)</option>
        <option value="Germany">Germany (DE / DEU)</option>
        <option value="Ghana">Ghana (GH / GHA)</option>
        <option value="Gibraltar">Gibraltar (GI / GIB)</option>
        <option value="Greece">Greece (GR / GRC)</option>
        <option value="Greenland">Greenland (GL / GRL)</option>
        <option value="Grenada">Grenada (GD / GRD)</option>
        <option value="Guadeloupe">Guadeloupe (GP / GLP)</option>
        <option value="Guam">Guam (GU / GUM)</option>
        <option value="Guatemala">Guatemala (GT / GTM)</option>
        <option value="Guinea">Guinea (GN / GIN)</option>
        <option value="Guinea-Bissau">Guinea-Bissau (GW / GNB)</option>
        <option value="Guyana">Guyana (GY / GUY)</option>
        <option value="Haiti">Haiti (HT / HTI)</option>
        <option value="Holy See (Vatican City)">Holy See (Vatican City) (VA / VAT)</option>
        <option value="Honduras">Honduras (HN / HND)</option>
        <option value="Hong Kong">Hong Kong (HK / HKG)</option>
        <option value="Hungary">Hungary (HU / HUN)</option>
        <option value="Iceland">Iceland (IS / IS)</option>
        <option value="India">India (IN / IND)</option>
        <option value="Indonesia">Indonesia (ID / IDN)</option>
        <option value="Iran">Iran (IR / IRN)</option>
        <option value="Iraq">Iraq (IQ / IRQ)</option>
        <option value="Ireland">Ireland (IE / IRL)</option>
        <option value="Isle of Man">Isle of Man (IM / IMN)</option>
        <option value="Israel">Israel (IL / ISR)</option>
        <option value="Italy">Italy (IT / ITA)</option>
        <option value="Ivory Coast (Côte d'Ivoire)">Ivory Coast (Côte d'Ivoire) (CI / CIV)</option>
        <option value="Jamaica">Jamaica (JM / JAM)</option>
        <option value="Japan">Japan (JP / JPN)</option>
        <option value="Jersey">Jersey (JE / JEY)</option>
        <option value="Jordan">Jordan (JO / JOR)</option>
        <option value="Kazakhstan">Kazakhstan (KZ / KAZ)</option>
        <option value="Kenya">Kenya (KE / KEN)</option>
        <option value="Kiribati">Kiribati (KI / KIR)</option>
        <option value="Kuwait">Kuwait (KW / KWT)</option>
        <option value="Kyrgyzstan">Kyrgyzstan (KG / KGZ)</option>
        <option value="Laos">Laos (LA / LAO)</option>
        <option value="Latvia">Latvia (LV / LVA)</option>
        <option value="Lebanon">Lebanon (LB / LBN)</option>
        <option value="Lesotho">Lesotho (LS / LSO)</option>
        <option value="Liberia">Liberia (LR / LBR)</option>
        <option value="Libya">Libya (LY / LBY)</option>
        <option value="Liechtenstein">Liechtenstein (LI / LIE)</option>
        <option value="Lithuania">Lithuania (LT / LTU)</option>
        <option value="Luxembourg">Luxembourg (LU / LUX)</option>
        <option value="Macau">Macau (MO / MAC)</option>
        <option value="Macedonia">Macedonia (MK / MKD)</option>
        <option value="Madagascar">Madagascar (MG / MDG)</option>
        <option value="Malawi">Malawi (MW / MWI)</option>
        <option value="Malaysia">Malaysia (MY / MYS)</option>
        <option value="Maldives">Maldives (MV / MDV)</option>
        <option value="Mali">Mali (ML / MLI)</option>
        <option value="Malta">Malta (MT / MLT)</option>
        <option value="Marshall Islands">Marshall Islands (MH / MHL)</option>
        <option value="Martinique">Martinique (MQ / MTQ)</option>
        <option value="Mauritania">Mauritania (MR / MRT)</option>
        <option value="Mauritius">Mauritius (MU / MUS)</option>
        <option value="Mayotte">Mayotte (YT / MYT)</option>
        <option value="Mexico">Mexico (MX / MEX)</option>
        <option value="Micronesia">Micronesia (FM / FSM)</option>
        <option value="Moldova">Moldova (MD / MDA)</option>
        <option value="Monaco">Monaco (MC / MCO)</option>
        <option value="Mongolia">Mongolia (MN / MNG)</option>
        <option value="Montenegro">Montenegro (ME / MNE)</option>
        <option value="Montserrat">Montserrat (MS / MSR)</option>
        <option value="Morocco">Morocco (MA / MAR)</option>
        <option value="Mozambique">Mozambique (MZ / MOZ)</option>
        <option value="Namibia">Namibia (NA / NAM)</option>
        <option value="Nauru">Nauru (NR / NRU)</option>
        <option value="Nepal">Nepal (NP / NPL)</option>
        <option value="Netherlands">Netherlands (NL / NLD)</option>
        <option value="Netherlands Antilles">Netherlands Antilles (AN / ANT)</option>
        <option value="New Caledonia">New Caledonia (NC / NCL)</option>
        <option value="New Zealand">New Zealand (NZ / NZL)</option>
        <option value="Nicaragua">Nicaragua (NI / NIC)</option>
        <option value="Niger">Niger (NE / NER)</option>
        <option value="Nigeria">Nigeria (NG / NGA)</option>
        <option value="Niue">Niue (NU / NIU)</option>
        <option value="Norfolk Island">Norfolk Island (NF / NFK)</option>
        <option value="North Korea">North Korea (KP / PRK)</option>
        <option value="Northern Mariana Islands">Northern Mariana Islands (MP / MNP)</option>
        <option value="Norway">Norway (NO / NOR)</option>
        <option value="Oman">Oman (OM / OMN)</option>
        <option value="Pakistan">Pakistan (PK / PAK)</option>
        <option value="Palau">Palau (PW / PLW)</option>
        <option value="Palestine">Palestine (PS / PSE)</option>
        <option value="Panama">Panama (PA / PAN)</option>
        <option value="Papua New Guinea">Papua New Guinea (PG / PNG)</option>
        <option value="Paraguay">Paraguay (PY / PRY)</option>
        <option value="Peru">Peru (PE / PER)</option>
        <option value="Philippines">Philippines (PH / PHL)</option>
        <option value="Pitcairn Islands">Pitcairn Islands (PN / PCN)</option>
        <option value="Poland">Poland (PL / POL)</option>
        <option value="Portugal">Portugal (PT / PRT)</option>
        <option value="Puerto Rico">Puerto Rico (PR / PRI)</option>
        <option value="Qatar">Qatar (QA / QAT)</option>
        <option value="Republic of the Congo">Republic of the Congo (CG / COG)</option>
        <option value="Reunion Island">Reunion Island (RE / REU)</option>
        <option value="Romania">Romania (RO / ROU)</option>
        <option value="Russia">Russia (RU / RUS)</option>
        <option value="Rwanda">Rwanda (RW / RWA)</option>
        <option value="Saint Barthelemy">Saint Barthelemy (BL / BLM)</option>
        <option value="Saint Helena">Saint Helena (SH / SHN)</option>
        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis (KN / KNA)</option>
        <option value="Saint Lucia">Saint Lucia (LC / LCA)</option>
        <option value="Saint Martin">Saint Martin (MF / MAF)</option>
        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon (PM / SPM)</option>
        <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines (VC / VCT)</option>
        <option value="Samoa">Samoa (WS / WSM)</option>
        <option value="San Marino">San Marino (SM / SMR)</option>
        <option value="Sao Tome and Principe">Sao Tome and Principe (ST / STP)</option>
        <option value="Saudi Arabia">Saudi Arabia (SA / SAU)</option>
        <option value="Senegal">Senegal (SN / SEN)</option>
        <option value="Serbia">Serbia (RS / SRB)</option>
        <option value="Seychelles">Seychelles (SC / SYC)</option>
        <option value="Sierra Leone">Sierra Leone (SL / SLE)</option>
        <option value="Singapore">Singapore (SG / SGP)</option>
        <option value="Sint Maarten">Sint Maarten (SX / SXM)</option>
        <option value="Slovakia">Slovakia (SK / SVK)</option>
        <option value="Slovenia">Slovenia (SI / SVN)</option>
        <option value="Solomon Islands">Solomon Islands (SB / SLB)</option>
        <option value="Somalia">Somalia (SO / SOM)</option>
        <option value="South Africa">South Africa (ZA / ZAF)</option>
        <option value="South Korea">South Korea (KR / KOR)</option>
        <option value="South Sudan">South Sudan (SS / SSD)</option>
        <option value="Spain">Spain (ES / ESP)</option>
        <option value="Sri Lanka">Sri Lanka (LK / LKA)</option>
        <option value="Sudan">Sudan (SD / SDN)</option>
        <option value="Suriname">Suriname (SR / SUR)</option>
        <option value="Svalbard">Svalbard (SJ / SJM)</option>
        <option value="Swaziland">Swaziland (SZ / SWZ)</option>
        <option value="Sweden">Sweden (SE / SWE)</option>
        <option value="Switzerland">Switzerland (CH / CHE)</option>
        <option value="Syria">Syria (SY / SYR)</option>
        <option value="Taiwan">Taiwan (TW / TWN)</option>
        <option value="Tajikistan">Tajikistan (TJ / TJK)</option>
        <option value="Tanzania">Tanzania (TZ / TZA)</option>
        <option value="Thailand">Thailand (TH / THA)</option>
        <option value="Timor-Leste">Timor-Leste (East Timor) (TL / TLS)</option>
        <option value="Togo">Togo (TG / TGO)</option>
        <option value="Tokelau">Tokelau (TK / TKL)</option>
        <option value="Tonga Islands">Tonga Islands (TO / TON)</option>
        <option value="Trinidad and Tobago">Trinidad and Tobago (TT / TTO)</option>
        <option value="Tunisia">Tunisia (TN / TUN)</option>
        <option value="Turkey">Turkey (TR / TUR)</option>
        <option value="Turkmenistan">Turkmenistan (TM / TKM)</option>
        <option value="Turks and Caicos Islands">Turks and Caicos Islands (TC / TCA)</option>
        <option value="Tuvalu">Tuvalu (TV / TUV)</option>
        <option value="Uganda">Uganda (UG / UGA)</option>
        <option value="Ukraine">Ukraine (UA / UKR)</option>
        <option value="United Arab Emirates">United Arab Emirates (AE / ARE)</option>
        <option value="United Kingdom">United Kingdom (GB / GBR)</option>
        <option value="United States">United States (US / USA)</option>
        <option value="Uruguay">Uruguay (UY / URY)</option>
        <option value="Uzbekistan">Uzbekistan (UZ / UZB)</option>
        <option value="Vanuatu">Vanuatu (VU / VUT)</option>
        <option value="Venezuela">Venezuela (VE / VEN)</option>
        <option value="Vietnam">Vietnam (VN / VNM)</option>
        <option value="Wallis and Futuna">Wallis and Futuna (WF / WLF)</option>
        <option value="Western Sahara">Western Sahara (EH / ESH)</option>
        <option value="Yemen">Yemen (YE / YEM)</option>
        <option value="Zambia">Zambia (ZM / ZMB)</option>
        <option value="Zimbabwe">Zimbabwe (ZW / ZWE)</option>
        </select>
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
    <a href="Home.php" class="hero-btn">Back</a> <input type="Submit" class="hero-btn" value="Submit" name="Submit">
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
