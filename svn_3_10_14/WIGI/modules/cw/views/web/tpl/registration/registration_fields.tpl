			<div id="signup" class="formlayout">
				
				<form action="{$formbase}registration/register" method="post">
					
					<div class="notes">
						<p>Before you start, you need to be able to access your email account and<br />should have the cell phone handy and on</p>
					</div>
					
					<div class="stepbox">
						
						<div class="notes">
							<h3>Personal Information</h3>
						</div>
						
						<div class="prompt firstname">
							<label for="firstname">Legal First Name</label>
							<input type="text" name="FIRST_NAME" id="firstname" maxlength="30" value="{$FIRST_NAME}" />
							<p class="tip">What is your first name?</p>
						</div>
						<div class="prompt lastname">
							<label for="lastname">Legal Last Name</label>
							<input type="text" name="LAST_NAME" id="lastname" maxlength="30" value="{$LAST_NAME}" />
							<p class="tip">What is your last name?</p>
						</div>
						<div class="prompt birth birthdate">
							<label for="birth_month">Date of Birth</label>
							<select name="BIRTH_MONTH" id="birth_month"><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select>
							<select name="BIRTH_DAY" id="birth_day"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select>
							<select name="BIRTH_YEAR" id="birth_year"><option value="1910">1910</option><option value="1911">1911</option><option value="1912">1912</option><option value="1913">1913</option><option value="1914">1914</option><option value="1915">1915</option><option value="1916">1916</option><option value="1917">1917</option><option value="1918">1918</option><option value="1919">1919</option><option value="1920">1920</option><option value="1921">1921</option><option value="1922">1922</option><option value="1923">1923</option><option value="1924">1924</option><option value="1925">1925</option><option value="1926">1926</option><option value="1927">1927</option><option value="1928">1928</option><option value="1929">1929</option><option value="1930">1930</option><option value="1931">1931</option><option value="1932">1932</option><option value="1933">1933</option><option value="1934">1934</option><option value="1935">1935</option><option value="1936">1936</option><option value="1937">1937</option><option value="1938">1938</option><option value="1939">1939</option><option value="1940">1940</option><option value="1941">1941</option><option value="1942">1942</option><option value="1943">1943</option><option value="1944">1944</option><option value="1945">1945</option><option value="1946">1946</option><option value="1947">1947</option><option value="1948">1948</option><option value="1949">1949</option><option value="1950">1950</option><option value="1951">1951</option><option value="1952">1952</option><option value="1953">1953</option><option value="1954">1954</option><option value="1955">1955</option><option value="1956">1956</option><option value="1957">1957</option><option value="1958">1958</option><option value="1959">1959</option><option value="1960">1960</option><option value="1961">1961</option><option value="1962">1962</option><option value="1963">1963</option><option value="1964">1964</option><option value="1965">1965</option><option value="1966">1966</option><option value="1967">1967</option><option value="1968">1968</option><option value="1969">1969</option><option value="1970">1970</option><option value="1971">1971</option><option value="1972">1972</option><option value="1973">1973</option><option value="1974">1974</option><option value="1975">1975</option><option value="1976">1976</option><option value="1977">1977</option><option value="1978">1978</option><option value="1979">1979</option><option value="1980">1980</option><option value="1981">1981</option><option value="1982">1982</option><option value="1983">1983</option><option value="1984">1984</option><option value="1985">1985</option><option value="1986">1986</option><option value="1987">1987</option><option value="1988">1988</option><option value="1989">1989</option><option value="1990">1990</option><option value="1991">1991</option><option value="1992">1992</option><option value="1993">1993</option><option value="1994">1994</option><option value="1995">1995</option><option value="1996">1996</option><option value="1997">1997</option><option value="1998">1998</option><option value="1999">1999</option><option value="2000">2000</option><option value="2001">2001</option><option value="2002">2002</option><option value="2003">2003</option><option value="2004">2004</option><option value="2005">2005</option><option value="2006">2006</option><option value="2007">2007</option><option value="2008">2008</option><option value="2009">2009</option><option value="2010">2010</option><option value="2011" selected="selected">2011</option><option value="2012">2012</option></select>
							<input type="hidden" id="birthdate" name="BIRTHDATE" value="01/01/1910" />
							<p class="tip">Your date of birth for security reasons</p>
						</div>
						<div class="prompt zip">
							<label for="zip">Zip Code</label>
							<input type="text" name="ZIP" id="zip" maxlength="5" value="{$ZIP}" />
							<p class="tip">What is your zip code?</p>
						</div>
						<div class="prompt address">
							<label for="address">Address 1</label>
							<input type="text" name="ADDRESS" id="address" maxlength="30" value="{$ADDRESS}" />
							<p class="tip">What is your address?</p>
						</div>
						<div class="prompt address2">
							<label for="address">Address 2</label>
							<input type="text" name="ADDRESS2" id="address2" maxlength="30" value="{$ADDRESS2}" />
							<p class="tip">Apartment, suite, etc.</p>
						</div>
						<div class="prompt city">
							<label for="city">City</label>
							<input type="text" name="CITY" id="city" maxlength="24" value="{$CITY}" />
							<p class="tip">Enter your city</p>
						</div>
						<div class="prompt state">
							<label for="state">State</label>
							{if true == false}<select name="STATE" id="state"><option value="">Choose...</option>{foreach from=$states key=si item=st}<option value="{$st}"{if $STATE == $st} selected="selected"{/if}>{$st}</option>{/foreach}</select>{/if}
							<input type="text" name="STATE" id="state" value="{$STATE}" readonly="readonly" />
							<p class="tip">Select your state</p>
						</div>
					
					</div>
					
					<div class="stepbox">
					
						<div class="notes">
							<h3>Web Access Setup</h3>
							<p>Your Web Login ID will be your email address</p>
						</div>
						
						<div class="prompt email checkexisting">
							<label for="email">Web Login ID</label>
							<input type="text" name="EMAIL" id="email" maxlength="60" value="{$EMAIL}" />
							<p class="tip">Enter your email address</p>
						</div>
						<div class="prompt email_confirm">
							<label for="email_confirm">Web Login ID (confirm)</label>
							<input type="text" name="EMAIL_CONFIRM" id="email_confirm" maxlength="60" value="{$EMAIL}" />
							<p class="tip">Repeat your email address</p>
						</div>
						<div class="prompt advpassword">
							<div class="password_strength"><div class="level"></div></div>
							<label for="password">Password</label>
							<input type="password" name="PASSWORD" id="password" maxlength="30" />
							<p class="tip">Enter your password (min. 8 characters, strong)</p>
						</div>
						<div class="prompt advpassword_confirm">
							<label for="password_confirm">Password (confirm)</label>
							<input type="password" name="PASSWORD_CONFIRM" id="password_confirm" maxlength="30" />
							<p class="tip">Repeat password</p>
						</div>
					
					</div>
					
					<div class="stepbox">
						
						<div class="notes">
							<h3>Cell Phone Access Setup (Default Cell Phone)</h3>
							<p>To access the Mobile app on your cell phone,<br />you will use your cell phone number and the PIN</p>
							<p><small>(You will be able to add additional cell phones later on)</small></p>
						</div>
						
						<div class="prompt cellphone checkexisting">
							<label for="countrycode">Cell Phone</label>
							<select id="countrycode" name="COUNTRY_CODE"><option value="1">91 (IN)</option></select>
							<input type="text" name="CELLPHONE" id="cellphone" size="12" maxlength="16" value="{$CELLPHONE}" />
							<p class="tip">Your 10-digit smartphone cell phone number</p>
						</div>
						<div class="prompt pin">
							<label for="pin">PIN</label>
							<input type="password" name="PIN" id="pin" maxlength="7" />
							<p class="tip">Enter PIN number (7 digits)</p>
						</div>
						<div class="prompt pin_confirm">
							<label for="pin_confirm">PIN (confirm)</label>
							<input type="password" name="PIN_CONFIRM" id="pin_confirm" maxlength="7" />
							<p class="tip">Repeat PIN number</p>
						</div>
						
					</div>
					
					<div class="stepbox">
						
						<div class="notes">
							<h3>Security Questions</h3>
						</div>
						
						<div class="prompt question">
							<label for="question">Security Question</label>
							<select name="QUESTION" id="question"><option value="">Choose...</option>{foreach name=questions_loop from=$questions item=q}<option value="{$q}">{$q}</option>{/foreach}</select>
							<p class="tip">Choose a security question</p>
						</div>
						<div class="prompt answer">
							<label for="answer">Security Answer</label>
							<input type="text" name="ANSWER" id="answer" maxlength="15" value="{$ANSWER}" />
							<p class="tip">Enter security answer</p>
						</div>
						
					</div>
					
					<div class="stepbox">
						
						<div class="notes">
							<p>The email you provided will be used to activate the account,<br />and we will also send a text message to activate your cell phone</p>
						</div>
						
					</div>
					
					<div class="submit">
						
						<div class="notes">
							<p>By clicking below, I certify that the information I have provided is correct,<br />and that I have read and agree to the <a href="http://brdev01.wigime.com/termsandconditions.php" target="_blank">Terms and Conditions</a></p>
							<input type="submit" value="Create Account" id="register" />
						</div>
						
					</div>
					
				</form>
				
			</div>