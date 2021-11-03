<script>
  console.log('Hello.');
</script>

<h2>Sample dialog</h2>

<div id="deque-dialog" class="deque-dialog" data-id="first-deque-dialog">
  <div class="deque-dialog-screen-wrapper"></div>
  <div class="deque-dialog-screen">
    <h1 id="dialogHeading" class="deque-dialog-heading">Simple Dialog</h1>
    <p class="deque-dialog-description" id="dialogDescription">Please enter your first and last name.</p>
    <form class="deque-dialog-content">
      <label for="nameInput">First Name</label>
      <input class="deque-input" id="nameInput" type="text" data-trap-enter="true">
      <label for="lastNameInput">Last Name</label>
      <input class="deque-input" id="lastNameInput" type="text" data-trap-enter="true">
    </form>
    <div class="deque-dialog-buttons">
      <button class="deque-button deque-dialog-button-submit">Submit</button>
      <button class="deque-button deque-dialog-button-cancel">Cancel</button>
      <button class="deque-dialog-button-close" aria-label="Close dialog"><span aria-hidden="true"></span></button>
    </div>
  </div>
</div>
<div>
  <button id="deque-dialog-trigger" class="deque-dialog-trigger hideFromQuizHint deque-button" aria-controls="deque-dialog"  data-id="first-deque-dialog">Show Dialog!</button>
</div>



<h2>Sample predictive text component</h2>
<div class="deque-predictive-text">
  <form id="chooseState">
    <label for="acInput">What state do you live in?</label>
    <div id="states-predictive-text"></div>
    <input type="submit" class="deque-button" value="Submit">
  </form>
</div>

<div id = "myContainer">this is my container</div>
<script>
var data = ['Alabama','Alaska','American Samoa',
  'Arizona','Arkansas','California','Colorado','Connecticut',
  'Delaware','District of Columbia','Federated States of Micronesia',
  'Florida','Georgia','Guam','Hawaii','Idaho','Illinois','Indiana',
  'Iowa','Kansas','Kentucky','Louisiana','Maine','Marshall Islands',
  'Maryland','Massachusetts','Michigan','Minnesota','Mississippi',
  'Missouri','Montana','Nebraska','Nevada','New Hampshire','New Jersey',
  'New Mexico','New York','North Carolina','North Dakota',
  'Northern Mariana Islands','Ohio','Oklahoma','Oregon','Palau',
  'Pennsylvania','Puerto Rico','Rhode Island','South Carolina',
  'South Dakota','Tennessee','Texas','Utah','Vermont','Virgin Island',
  'Virginia','Washington','West Virginia','Wisconsin','Wyoming'];
var config = {};

var ac = deque.createPredictiveText(data, config);
var input = ac.getInputElement();
input.id = 'acInput';

document
  .getElementById('states-predictive-text')
  .appendChild(ac);

/* The following is for optional form validation purposes */
input.setAttribute('data-validate','required');
var form1 = document.getElementById('chooseState');
deque.configureFormValidation(form1, {});
</script>



<script>
  var1 = "Hello";
  var2 = " World";
  console.log(var1 + var2);
  $("#myContainer").hmtl('hello universe').addClass("myClass").attr('aria-expanded', 'true');

</script>




