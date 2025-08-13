<style>
  .search-input {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
  }

  .dropdown {
    display: none;
    position: absolute;
    background: white;
    border: 1px solid #ddd;
    max-height: 200px;
    overflow-y: auto;
    width: 100%;
    z-index: 1000;
  }

  .dropdown-item {
    padding: 10px;
    cursor: pointer;
  }

  .dropdown-item:hover {
    background-color: #f0f0f0;
  }

  @keyframes borderAnimation {
    0% {
      border: 4px solid rgb(72, 178, 145);
      box-shadow: 0 0 10px red;
    }

    50% {
      border: 4px solid rgb(72, 178, 145);
      box-shadow: 0 0 10px green;
    }

  }

  .animated-border {
    display: inline-block;
    padding: 10px;
    border-radius: 20px;
    animation: borderAnimation 4s linear infinite;
    
  }
</style>
<section class="sgi__newsletter" id="subscribe_newsletter">
  <div class="container__fluid d__grid">
    <div class="title__tag space--lg clr__brand d__grid has__border">
      <h4 class="block__title">
        Stay up to date with the latest from Kenz Organic
      </h4>
    </div>

    <!--// Updated 22 Feb-->
    <div class="d__grid two--col custom__grid">
      <figure class="pos--relative animated-border">
        <picture>
          <source srcset="./media/images/image-67.jpg" type="image/webp" />
          <img
            src="./media/images/image-67.jpg"
            alt="newsletter"
            width="1200"
            height="600"
            loading="lazy"
            class="cover--img center" />
        </picture>
      </figure>


      <form
        id="newsletterForm"
        data-ajax="true"
        data-ajax-method="POST"
        data-ajax-begin=""
        data-ajax-failure="OnSubmitFailure"
        data-ajax-success="OnSubmitSuccess"
        data-ajax-complete=""
        action=""
        method="post">
        <div class="newsletter__form__wrapper form d__grid">
          <input
            type="hidden"
            value="1123"
            data-val="true"
            data-val-required="The ParentId field is required."
            id="ParentId"
            name="ParentId" />

          <div id="submitSuccess" hidden="">
            <svg
              fill="none"
              height="25"
              viewBox="0 0 25 25"
              width="25"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M22.6856 11.0895V12.0095C22.6843 14.1659 21.986 16.2642 20.6949 17.9913C19.4037 19.7185 17.5888 20.982 15.5209 21.5934C13.453 22.2048 11.2428 22.1314 9.22002 21.3841C7.19723 20.6367 5.4702 19.2556 4.29651 17.4465C3.12281 15.6375 2.56534 13.4975 2.70722 11.3458C2.84911 9.19404 3.68275 7.1458 5.08383 5.50655C6.4849 3.8673 8.37833 2.72486 10.4817 2.24962C12.5851 1.77439 14.7858 1.99181 16.7556 2.86948"
                stroke="green"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"></path>
              <path
                d="M22.6855 4.00949L12.6855 14.0195L9.68555 11.0195"
                stroke="green"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"></path>
            </svg>
            <h6>Details submitted successfully.</h6>
          </div>
          <div
            hidden=""
            id="submitFailure"
            class="fail-note d-flex align-items-center">
            <h6>Sorry! something went wrong. Try again</h6>
          </div>

          <div class="newsletter__form d__grid">
            <div class="d__grid two--col">
              <div class="form__control">
                <input
                  type="text"
                  placeholder="First Name *"
                  data-val="true"
                  data-val-required="Required"
                  id="FirstName"
                  name="FirstName"
                  required
                  value="" />
                <span id="invalidFirstName" hidden="" class="required">Required</span>
              </div>
              <div class="form__control">
                <input
                  type="text"
                  placeholder="Last Name"
                  data-val="true"
                  data-val-required="Required"
                  id="LastName"
                  name="LastName"
                  required
                  value="" />
              </div>
            </div>
            <div class="d__grid two--col">
              <div class="form__control">
                <input
                  type="text"
                  placeholder="Your Job *"
                  data-val="true"
                  data-val-required="Required"
                  id="YourJob"
                  name="YourJob"
                  required
                  value="" />
                <span id="invalidJob" hidden="" class="required">Required</span>
              </div>
              <div class="form__control">
                <input
                  type="text"
                  placeholder="Your Company *"
                  data-val="true"
                  data-val-required="Required"
                  id="YourCompany"
                  name="YourCompany"
                  required
                  value="" />
                <span id="invalidCompany" hidden="" class="required">Required</span>
              </div>
            </div>
            <div class="d__grid">
              <div class="form__control">
                <input
                  type="email"
                  placeholder="Email"
                  data-val="true"
                  data-val-email="Invalid"
                  data-val-required="Required"
                  id="Email"
                  name="Email"
                  value="" required />
                <span id="invalidEmail" hidden="" class="required">Required</span>
              </div>
            </div>
            <div class="d__grid two--col">
              <!-- Country Code Dropdown -->
              <div class="form__control" style="background-color:rgba(49, 49, 49, 1) 0%,;">
                <!-- <label for="CountryCodeSelect">Select Country Code:</label> -->
                <select id="CountryCodeSelect" class="select-box" name="CountryCode" style="padding: 10px; background-color:rgba(49, 49, 49, 1) 0%,;" required>
                  <!-- <option value="" disabled selected>-- Select a country code --</option> -->

                  <!-- Add more options as needed -->
                </select>
              </div>


              <!-- Mobile Number Input -->
              <div class="form__control">
                <input
                  type="tel"
                  placeholder="Mobile Number *"
                  data-val="true"
                  data-val-required="Required"
                  id="MobileNumber"
                  name="MobileNumber"
                  pattern="[0-9]{10}"
                  value=""
                  required />
                <span id="invalidMobile" hidden="" class="required">Required</span>
              </div>
            </div>
            <div class="d__grid">
              <div class="form__control">
                <textarea id="message" name="message" required placeholder="Message"></textarea>
              </div>
            </div>
            <div class="d__grid two--col checkbox__wrapper">
              <div class="custom__checkbox">
                <input
                  type="checkbox"
                  id="termsCondition"
                  name="termsCondition"
                  checked=""
                  required="" />
                <label for="termsCondition">I accept the Terms &amp; Conditions</label>
              </div>
              <div class="custom__checkbox">
                <input type="checkbox" id="privacyPolicy" required="" name="privacyPolicy" />
                <label for="privacyPolicy">I accept the Privacy Policy</label>
              </div>
            </div>
            <input
              type="hidden"
              name="newsletterbot"
              style="display: none" />
            <div class="cta__wrapper d__flex">
              <button
                id="btnSubmit"
                type="submit"
                class="btn__cta btn--green pos--relative">
                <i class="plus__icon start"></i>
                <span>Get in Touch</span>
                <i class="plus__icon end"></i>
              </button>

              <div id="dvSpinner" hidden="" class="spinner"></div>
            </div>
          </div>
        </div>
        <input
          name="__RequestVerificationToken"
          type="hidden"
          value="CfDJ8LmzwLcDy2VIl5Ojql4uAmRFO_UFDQpFBEwwQmq75Y52zOtFGK-xnafl1FWGv5uV2rnEDC55JIase9AQ_2ZktsSPpbI_T35Kzza6muu-58A7rISsrU_xwgNyHNSJQ5ihxof7lsMinJrzHBzy535nmGw" /><input name="SubscribeEventUpdates" type="hidden" value="false" />
      </form>
    </div>
  </div>
</section>

<script type="text/javascript">
  document.getElementById('newsletterForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Show the spinner to indicate loading
    document.getElementById('dvSpinner').removeAttribute('hidden');

    // Gather form data
    var formData = new FormData(this);

    // Create an XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../function/submit_form.php', true); // Set the request method and URL (submit_form.php is your server-side script)

    // Set up the callback function that runs when the response is received
    xhr.onload = function() {
      // Hide the spinner after the request is complete
      document.getElementById('dvSpinner').setAttribute('hidden', '');

      // Check if the request was successful (HTTP status 200)
      if (xhr.status === 200) {
        // If successful, show success message
        var response = xhr.responseText;
        if (response === 'Details submitted successfully.') {
          document.getElementById('submitSuccess').removeAttribute('hidden');
          document.getElementById('submitFailure').setAttribute('hidden', true);
          document.getElementById('newsletterForm').reset();
          fetchCountryCode();
        } else {
          // If there was an error, show failure message
          document.getElementById('submitFailure').removeAttribute('hidden');
          document.getElementById('submitSuccess').setAttribute('hidden', true);

        }
      } else {
        // If there was an error with the request, show failure message
        document.getElementById('submitFailure').removeAttribute('hidden');
        document.getElementById('submitSuccess').setAttribute('hidden', true);
      }
    };

    // Send the form data using AJAX (without page reload)
    xhr.send(formData);
  });

  function fetchCountryCode() {
    var current_country = '';
    const apiKey = "ZlkzaVR5cHRkaHkwRnNGQXlzVDRHWDVCT0w3NmxlOWtMaFk0NVNCdg==";
    const headers = new Headers();
    headers.append("X-CSCAPI-KEY", apiKey);

    const requestOptions = {
      method: 'GET',
      headers: headers,
      redirect: 'follow'
    };

    // Fetch and populate countries with the specified format
    fetch("https://api.countrystatecity.in/v1/countries", requestOptions)
      .then(response => response.json())
      .then(countries => {
        const countrySelect = document.getElementById('CountryCodeSelect');
        countries.forEach(country => {
          const option = document.createElement('option');
          option.value = country.phonecode; // Use phone code as value
          option.setAttribute('data-countryCode', country.iso2); // Set ISO code as data attribute
          option.textContent = `${country.name} (+${country.phonecode})`; // Display country name with phone code
          countrySelect.appendChild(option);
        });
      }).then(response => {
        fetch('https://ipinfo.io/json?token=05d29092b4fb6b') // Replace with your ipinfo.io token
          .then(response => response.json())
          .then(data => {
            // console.log(data.region)
            const country = data.country; // e.g., "US", "IN", etc.
            const select = document.getElementById('CountryCodeSelect');
            current_country = country;
            console.log(current_country);
            // Loop through options to find the matching country code
            for (let i = 0; i < select.options.length; i++) {
              // console.log(select.options[i].dataset.countrycode)
              if (select.options[i].dataset.countrycode === country) {
                select.selectedIndex = i;
                break;
              }
            }
          })
          .catch(error => console.log('Error fetching countries:', error));

      })
  }
  fetchCountryCode()
</script>