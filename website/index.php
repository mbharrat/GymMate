<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Gym Mate</title>
  <?php require ('helper-functions.php');?>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">GymMate</a>
      <div class="right">
        <?php if (isLoggedIn()!=false): ?> <!--if user is logged in show log out button-->
          <div><form action="/" method="post"><button class="btn waves-effect waves-light light-blue" type="submit" name="action-logout">Log Out</button></form></div>
        <?php endif; ?>
      </div>
    </nav>

    <?php if (isLoggedIn()!=false): ?> <!--user is logged in-->
      <div class="container">
        <div class="section">
          <div class="row">
            <div class="col s12">
              <center>Welcome <?php echo getSessionUser(); ?></center>




            </div>
          </div>
        </div>
      </div>
    <?php else: ?> <!--If User Is not Logged In Display Login Register Options-->
      <div class="container">
        <div class="section">
          <div class="row">
            <div class="col s12">
              <div class="row">
                <div class="col s12">
                  <ul class="tabs">
                    <li class="tab col s3"><a class="active" href="#login">Login</a></li>
                    <li class="tab col s3"><a href="#register">Register</a></li>
                  </ul>
                </div>
                <div id="login" class="col s12">
                  <!--Login Form Here-->
                  <form action="/" method="post">
                    <div class="row">
                      <div class="input-field col s6">
                        <input id="login_user_name" name="login_user_name" type="text" class="validate">
                        <label for="login_user_name">User Name</label>
                      </div>
                      <div class="input-field col s6">
                        <input id="login_password" name="login_password" type="password" class="validate">
                        <label for="login_password">Password</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 center">
                        <input type="checkbox" id="remember" name="remember"/>
                        <label for="remember">Remember Me</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button class="btn waves-effect waves-light light-blue" type="submit" name="action-login-user">Login<i class="material-icons right">send</i></button>
                      </div>
                    </div>
                  </form>
                </div>
                <div id="register" class="col s12">
                  <form action="/" method="post">
                    <!--Register Form Here-->
                    <div class="row">
                      <div class="input-field col s6">
                        <input id="user_name" name="user_name" type="text" class="validate">
                        <label for="user_name">User Name</label>
                      </div>
                      <div class="input-field col s6">
                        <input id="password" name="password" type="password" class="validate">
                        <label for="password">Password</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s4">
                        <select name="gender">
                          <option value="" disabled selected>Gender</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </div>
                      <div class="input-field col s2">
                        <input id="weight" name="weight" type="number" class="validate">
                        <label for="weight">Weight</label>
                      </div>
                      <div class="input-field col s2">
                        <select name="heightfeet">
                          <option value="" disabled selected>Height:Feet</option>
                          <option value="1">1 Foot</option>
                          <option value="2">2 Feet</option>
                          <option value="3">3 Feet</option>
                          <option value="4">4 Feet</option>
                          <option value="5">5 Feet</option>
                          <option value="6">6 Feet</option>
                          <option value="7">7 Feet</option>
                          <option value="8">8 Feet</option>
                          <option value="9">9 Feet</option>
                        </select>
                      </div>
                      <div class="input-field col s2">
                        <select name="heightinches">
                          <option value="" disabled selected>Height:Inches</option>
                          <option value="1">1 Inch</option>
                          <option value="2">2 Inches</option>
                          <option value="3">3 Inches</option>
                          <option value="4">4 Inches</option>
                          <option value="5">5 Inches</option>
                          <option value="6">6 Inches</option>
                          <option value="7">7 Inches</option>
                          <option value="8">8 Inches</option>
                          <option value="9">9 Inches</option>
                          <option value="10">10 Inches</option>
                          <option value="11">11 Inches</option>
                          <option value="12">12 Inches</option>
                        </select>
                      </div>
                      <div class="input-field col s2">
                        <input id="age" name="age" type="number" class="validate">
                        <label for="age">Age</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="experience" name="experience" type="number" class="validate">
                        <label for="experience">Years of Experience</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <select name="goal">
                          <option value="" disabled selected>Your Goal</option>
                          <option value="lose weight">Lose Weight</option>
                          <option value="maintain weight">Maintain Weight</option>
                          <option value="gain weight">Gain Weight</option>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 center">
                        <button class="btn waves-effect waves-light light-blue" type="submit" name="action-create-user">Register<i class="material-icons right">send</i></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?><br><br>
    <div class="container">
      <div class="section">
        <div class="row">
          <div class="col s12">
            <ul class="tabs">
              <li class="tab col s3"><a <?php if ($gymQueryStack[1]): ?>class="active" <?php endif; ?>href="#gyms">Gyms</a></li>
              <li class="tab col s3"><a <?php if ($userQueryStack[0][0]): ?>class="active" <?php endif; ?>href="#users">Users</a></li>
              <li class="tab col s3"><a <?php if ($exerciseQueryStack[1]): ?>class="active" <?php endif; ?>href="#exercises">Exercises</a></li>
              <li class="tab col s3"><a <?php if ($supplementQueryStack[1]): ?>class="active" <?php endif; ?>href="#supplements">Supplements</a></li>
            </ul>
          </div>
          <div id="gyms" class="col s12">
            <div class="col s12">
              <ul class="tabs">
                <li class="tab col s6"><a class="active" href="#gymQuery" id="tab_map_query_link">Query</a></li>
                <li class="tab col s6"><a href="#gymViewAll" id="tab_map_link">View All</a></li>
              </ul>
            </div>
            <div id="gymQuery" class="col s12">
              <form action="/" method="post">
                <div class="row">
                  <div class="input-field col s6">
                    <input id="gymState" name="gymState" type="text" class="validate">
                    <label for="gymState">State</label>
                  </div>
                  <div class="input-field col s6">
                    <input id="gymOpenTime" name="gymOpenTime" type="text" class="validate">
                    <label for="gymOpenTime">Open Time</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col s12 center">
                    <button class="btn waves-effect waves-light light-blue" type="submit" name="action-gym-query">Query Gyms<i class="material-icons right">send</i></button>
                  </div>
                </div>
              </form>
              <?php if ($gymQueryStack[1]): ?>
                <div id="map_query_canvas" style="width:100%; height:300px;"></div>
                <ul class="collapsible" data-collapsible="accordion">
                  <li>
                    <div class="collapsible-header row">
                      <div class="col s2">Gym Name</div>
                      <div class="col s2">Address</div>
                      <div class="col s2">State</div>
                      <div class="col s2">Open Time</div>
                      <div class="col s2">Phone Number</div>
                      <div class="col s2">Distance</div>
                    </div>
                  </li>

                  <?php $gymInnerStack=$gymQueryStack[1]; ?>
                  <?php for($x=0;$x<count($gymQueryStack[1]);$x++) : ?>
                    <li>
                      <div class="collapsible-header row">
                        <?php for($y=0;$y<count($gymQueryStack[1][$x]);$y++) : ?>
                          <div class="col s2"><?php echo $gymQueryStack[1][$x][$y]; ?></div>
                        <?php endfor; ?>
                      </div>
                      <div class="collapsible-body"><p>
                        <b>Exercises Supported:</b> <?php echo getExercisesSupported($gymQueryStack[1][$x][0]);?>
                        <br><br><b>Who Goes Here:</b> <?php echo getGymUsers($gymQueryStack[1][$x][0]);?>
                      </p></div>
                    </li>
                  <?php endfor; ?>
                </ul>
              <?php endif; ?>
            </div>
            <div id="gymViewAll" class="col s12">
              <div id="map_canvas" style="width:100%; height:300px;"></div>
              <ul class="collapsible" data-collapsible="accordion">
               <li>
                <div class="collapsible-header row">
                  <div class="col s2">Gym Name</div>
                  <div class="col s2">Address</div>
                  <div class="col s2">State</div>
                  <div class="col s2">Open Time</div>
                  <div class="col s2">Phone Number</div>
                  <div class="col s2">Distance</div>
                </div>
              </li>

              <?php $gymStack=getGymFieldsArr(); ?>
              <?php for($x=0;$x<count($gymStack);$x++) : ?>
                <li>
                  <div class="collapsible-header row">
                    <?php for($y=0;$y<count($gymStack[$x]);$y++) : ?>
                      <div class="col s2"><?php echo $gymStack[$x][$y]; ?></div>
                    <?php endfor; ?>
                  </div>
                  <div class="collapsible-body"><p>
                    <b>Exercises Supported:</b> <?php echo getExercisesSupported($gymStack[$x][0]);?>
                    <br><br><b>Who Goes Here:</b> <?php echo getGymUsers($gymStack[$x][0]);?>
                  </p></div>
                </li>
              <?php endfor; ?>
            </ul>
          </div>
        </div>
        <div id="users" class="col s12">
          <div class="col s12">
            <ul class="tabs">
              <li class="tab col s6"><a class="active" href="#usersQuery">Query</a></li>
              <li class="tab col s6"><a href="#usersViewAll">View All</a></li>
            </ul>
          </div>
          <div id="usersQuery" class="col s12">
            <form action="/" method="post">
              <div class="row">
                <div class="input-field col s4">
                  <input id="userName" name="userName" type="text" class="validate">
                  <label for="userName">Name</label>
                </div>
                <div class="input-field col s3">
                  <input id="userGoal" name="userGoal" type="text" class="validate">
                  <label for="userGoal">Goal</label>
                </div>
                <div class="input-field col s3">
                  <input id="userGym" name="userGym" type="text" class="validate">
                  <label for="userGym">Gym</label>
                </div>
                <div class="input-field col s1">
                  <input id="userGender" name="userGender" type="text" class="validate">
                  <label for="userGender">Gender</label>
                </div>
                <div class="input-field col s1">
                  <input id="userAge" name="userAge" type="text" class="validate">
                  <label for="userAge">Age</label>
                </div>
              </div>
              <div class="row">
                <div class="col s12 center">
                  <button class="btn waves-effect waves-light light-blue" type="submit" name="action-users-query">Query Users<i class="material-icons right">send</i></button>
                </div>
              </div>
            </form>
            <?php if ($userQueryStack[0][0]): ?>
              <ul class="collapsible" data-collapsible="accordion">
                <li>
                  <div class="collapsible-header row">
                    <div class="col s3">User Name</div>
                    <div class="col s2">Gender</div>
                    <div class="col s1 center">Exp.(yrs)</div>
                    <div class="col s1 center">Wt.(lbs)</div>
                    <div class="col s1 center">Height (inches)</div>
                    <div class="col s3">Goal</div>
                    <div class="col s1 center">Age</div>
                  </div>
                </li>
                <?php for($x2=0;$x2<count($userQueryStack);$x2++) : ?>
                  <li>
                    <div class="collapsible-header row">
                      <?php for($y2=0;$y2<count($userQueryStack[$x2]);$y2++) : ?>
                        <?php if (($y2==0)||($y2==5)): ?>
                          <div class="col s3">
                            <?php echo $userQueryStack[$x2][$y2]; ?>
                          </div>
                        <?php elseif ($y2==1): ?>
                          <div class="col s2">
                            <?php echo $userQueryStack[$x2][$y2]; ?>
                          </div>
                        <?php else: ?>
                          <div class="col s1 center">
                            <?php echo $userQueryStack[$x2][$y2]; ?>
                          </div>
                        <?php endif; ?>
                      <?php endfor; ?>
                    </div>
                  </li>
                <?php endfor; ?>
              </ul>
            <?php endif; ?>
          </div>
          <div id="usersViewAll" class="col s12">
            <ul class="collapsible" data-collapsible="accordion">
              <li>
                <div class="collapsible-header row">
                  <div class="col s3">User Name</div>
                  <div class="col s2">Gender</div>
                  <div class="col s1 center">Exp.(yrs)</div>
                  <div class="col s1 center">Wt.(lbs)</div>
                  <div class="col s1 center">Height (inches)</div>
                  <div class="col s3">Goal</div>
                  <div class="col s1 center">Age</div>
                </div>
              </li>
              <?php $userStack=getUserFieldsArr(); ?>
              <?php for($x=0;$x<count($userStack);$x++) : ?>
                <li>
                  <div class="collapsible-header row">
                    <?php for($y=0;$y<count($userStack[$x]);$y++) : ?>
                      <?php if (($y==0)||($y==5)): ?>
                        <div class="col s3">
                          <?php echo $userStack[$x][$y]; ?>
                        </div>
                      <?php elseif ($y==1): ?>
                        <div class="col s2">
                          <?php echo $userStack[$x][$y]; ?>
                        </div>
                      <?php else: ?>
                        <div class="col s1 center">
                          <?php echo $userStack[$x][$y]; ?>
                        </div>
                      <?php endif; ?>
                    <?php endfor; ?>
                  </div>
                </li>
              <?php endfor; ?>
            </ul>
          </div>
        </div>
        <div id="exercises" class="col s12">
          <div class="col s12">
            <ul class="tabs">
              <li class="tab col s6"><a class="active" href="#exerciseQuery">Query</a></li>
              <li class="tab col s6"><a href="#exerciseViewAll">View All</a></li>
            </ul>
          </div>
          <div id="exerciseQuery" class="col s12">
            <form action="/" method="post">
              <div class="row">
                <div class="input-field col s3">
                  <input id="exerciseName" name="exerciseName" type="text" class="validate">
                  <label for="exerciseName">Exercise Name</label>
                </div>
                <div class="input-field col s3">
                  <input id="bodyPart" name="bodyPart" type="text" class="validate">
                  <label for="bodyPart">Body Part</label>
                </div>
                <div class="input-field col s3">
                  <input id="difficulty" name="difficulty" type="text" class="validate">
                  <label for="difficulty">Exercise Difficulty</label>
                </div>
                <div class="input-field col s3">
                  <input id="rating" name="rating" type="text" class="validate">
                  <label for="rating">Rating</label>
                </div>
              </div>
              <div class="row">
                <div class="col s12 center">
                  <button class="btn waves-effect waves-light light-blue" type="submit" name="action-exercise-query">Query Exercises<i class="material-icons right">send</i></button>
                </div>
              </div>
            </form>
            <?php if ($exerciseQueryStack[1]): ?>
              <ul class="collapsible" data-collapsible="accordion">
                <li>
                  <div class="collapsible-header row">
                    <div class="col s3">Exercise Name</div>
                    <div class="col s3">Body Part</div>
                    <div class="col s3">Difficulty</div>
                    <div class="col s3">Exercise Rating</div>
                  </div>
                </li>
                <?php for($x=0;$x<count($exerciseQueryStack);$x++) : ?>
                  <li>
                    <div class="collapsible-header row">
                      <?php for($y=0;$y<count($exerciseQueryStack[$x]);$y++) : ?>
                        <div class="col s3"><?php echo $exerciseQueryStack[$x][$y]; ?></div>
                      <?php endfor; ?>
                    </div>
                  </li>
                <?php endfor; ?>
              </ul>
            <?php endif; ?>
          </div>

          <div id="exerciseViewAll" class="col s12">
            <ul class="collapsible" data-collapsible="accordion">
              <li>
                <div class="collapsible-header row">
                  <div class="col s3">Exercise Name</div>
                  <div class="col s3">Body Part</div>
                  <div class="col s3">Difficulty</div>
                  <div class="col s3">Exercise Rating</div>
                </div>
              </li>

              <?php $exerciseStack=getExerciseFieldsArr(); ?>
              <?php for($x=0;$x<count($exerciseStack);$x++) : ?>
                <li>
                  <div class="collapsible-header row">
                    <?php for($y=0;$y<count($exerciseStack[$x]);$y++) : ?>
                      <div class="col s3"><?php echo $exerciseStack[$x][$y]; ?></div>
                    <?php endfor; ?>
                  </div>
                </li>
              <?php endfor; ?>
            </ul>
          </div>
        </div>
        <div id="supplements" class="col s12">
          <div class="col s12">
            <ul class="tabs">
              <li class="tab col s6"><a class="active" href="#supplementQuery">Query</a></li>
              <li class="tab col s6"><a href="#supplementViewAll">View All</a></li>
            </ul>
          </div>
          <div id="supplementQuery" class="col s12">
            <form action="/" method="post">
              <div class="row">
                <div class="input-field col s4">
                  <input id="supplementName" name="supplementName" type="text" class="validate">
                  <label for="supplementName">Supplement Name</label>
                </div>
                <div class="input-field col s4">
                  <input id="supplementBrand" name="supplementBrand" type="text" class="validate">
                  <label for="supplementBrand">Supplement Brand</label>
                </div>
                <div class="input-field col s4">
                  <input id="supplementType" name="supplementType" type="text" class="validate">
                  <label for="supplementType">Supplement Type</label>
                </div>
              </div>
              <div class="row">
                <div class="col s12 center">
                  <button class="btn waves-effect waves-light light-blue" type="submit" name="action-supplement-query">Query Supplements<i class="material-icons right">send</i></button>
                </div>
              </div>
            </form>
            <?php if ($supplementQueryStack[1]): ?>
              <ul class="collapsible" data-collapsible="accordion">
                <li>
                  <div class="collapsible-header row">
                    <div class="col s3">Brand Name</div>
                    <div class="col s3">Supplement Name</div>
                    <div class="col s1">Price</div>
                    <div class="col s3">Type</div>
                    <div class="col s2">Rating</div>
                  </div>
                </li>

                <?php for($x=0;$x<count($supplementQueryStack);$x++) : ?>
                  <li>
                    <div class="collapsible-header row">
                      <?php for($y=0;$y<count($supplementQueryStack[$x]);$y++) : ?>
                        <?php if ($y==2): ?>
                          <div class="col s1"><?php echo $supplementQueryStack[$x][$y]; ?></div>
                        <?php elseif ($y==4): ?>
                          <div class="col s2"><?php echo $supplementQueryStack[$x][$y]; ?></div>
                        <?php else: ?>
                          <div class="col s3"><?php echo $supplementQueryStack[$x][$y]; ?></div>
                        <?php endif; ?>
                      <?php endfor; ?>
                    </div>
                  </li>
                <?php endfor; ?>
              </ul>
            <?php endif; ?>
          </div>
          <div id="supplementViewAll" class="col s12">
            <ul class="collapsible" data-collapsible="accordion">
              <li>
                <div class="collapsible-header row">
                  <div class="col s3">Brand Name</div>
                  <div class="col s3">Supplement Name</div>
                  <div class="col s1">Price</div>
                  <div class="col s3">Type</div>
                  <div class="col s2">Rating</div>
                </div>
              </li>

              <?php $supplementStack=getSupplementFieldsArr(); ?>
              <?php for($x=0;$x<count($supplementStack);$x++) : ?>
                <li>
                  <div class="collapsible-header row">
                    <?php for($y=0;$y<count($supplementStack[$x]);$y++) : ?>
                      <?php if ($y==2): ?>
                        <div class="col s1"><?php echo $supplementStack[$x][$y]; ?></div>
                      <?php elseif ($y==4): ?>
                        <div class="col s2"><?php echo $supplementStack[$x][$y]; ?></div>
                      <?php else: ?>
                        <div class="col s3"><?php echo $supplementStack[$x][$y]; ?></div>
                      <?php endif; ?>
                    <?php endfor; ?>
                  </div>
                </li>
              <?php endfor; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="page-footer orange">
    <div class="container"></div>
    <div class="footer-copyright">
      <div class="container">
        Made by <a class="orange-text text-lighten-3">Mike and Prasant</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="http://code.jquery.com/jquery-latest.min.js"></script> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
  <!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>-->
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?    v=3.exp&libraries=places,drawing,geometry"></script>
  <script>
    $(document).ready(function() {
      $('select').material_select();
    });
  </script>
  <!--Google Maps Script View All-->
  <script>
    var map;
    //var myOptions
    $(document).ready(function () {
      var addresses = <?php echo json_encode($AddrStack); ?>;
      //var map;
      var elevator;
      var myOptions = {
        zoom: 3,
        center: new google.maps.LatLng(44.29024, -125.712891),
        mapTypeId: 'roadmap'
      };
      map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
      //map = new google.maps.Map($('#map_canvas')[0], myOptions);
      for (var x = 0; x < addresses.length; x++) {
        $.getJSON('http://maps.googleapis.com/maps/api/geocode/json?address='+addresses[x], null, function (data) {
          var p = data.results[0].geometry.location;
          var latlng = new google.maps.LatLng(p.lat, p.lng);
          var markerb=new google.maps.Marker({
            position: latlng,
            map: map
          });
        });
      }
    });

    $('#tab_map_link').on('click',function(){
      setTimeout(function(){
        google.maps.event.trigger(map,'resize')
      }, 500);
    });

  </script>
  <?php if ($gymQueryStack[1]): ?>
    <script>
      var querymap;
      $(document).ready(function () {
        var addresses = <?php echo json_encode($gymQueryStack[0]); ?>;
        //var map2;
        var elevator;
        var myOptions = {
          zoom: 3,
          center: new google.maps.LatLng(36.09024, -100.712891),
          mapTypeId: 'roadmap'
        };
        querymap = new google.maps.Map($('#map_query_canvas')[0], myOptions);
        for (var x = 0; x < addresses.length; x++) {
          $.getJSON('http://maps.googleapis.com/maps/api/geocode/json?address='+addresses[x], null, function (data) {
            var p = data.results[0].geometry.location;
            var latlng = new google.maps.LatLng(p.lat, p.lng);
            var markerb=new google.maps.Marker({
              position: latlng,
              map: querymap
            });
          });
        }
      });
      $('#tab_map_query_link').on('click',function(){
        setTimeout(function(){
          google.maps.event.trigger(querymap,'resize')
        }, 500);
      });
    </script>
  <?php endif; ?>
</body>
</html>