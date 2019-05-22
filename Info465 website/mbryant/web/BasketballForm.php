<?php

require(dirname(pathinfo(__FILE__, PATHINFO_DIRNAME)) . "/SiteSettings.php" );
AllowLoggedIn();

  
function MakeTheForm($ValidationErrors) {
  if (isset($_POST['MAName'])) {
    extract($_POST);
  } else {
    $MAName = '';
    $MAEmail = '';
    $MASMS = '';
    $MAOpinion = '';
    $MAShoes = '';
    $MAPass1 = '';
    $MAPass2 = '';
    $MAFavoriteBasketball = '';
    $MAFavoriteTeams ='';
    $MAFavoriteCD = '';
    $MAFavoriteDiv = '';
  }
  $RedSplat = " <span class=\"Flag\">* </span> ";
  $TheForm = "<p>Complete all sections of the form and
     click Submit Form when you're done... </p>
    <fieldset>
      <legend>Name &amp; Contact Data</legend>\n";
  if (isset($ValidationErrors['MAName'])) { $SplatSlug = $RedSplat; } else { $SplatSlug = ''; }
  
  $TheForm .= "      <p><label for=\"MAName\">$SplatSlug Name:</label>
          <input type=\"text\" name=\"MAName\" id=\"MAName\" value=\"$MAName\" placeholder=\"As you'd prefer to be addressed\" autofocus />
            </p><br /> \n";
  if (isset($ValidationErrors['MAEmail'])) { $SplatSlug = $RedSplat; } else { $SplatSlug = ''; }
  $TheForm .= "       <p><label for=\"MAEmail\">$SplatSlug Email:</label>
          <input type=\"text\" name=\"MAEmail\" id=\"MAEmail\" value=\"$MAEmail\" placeholder=\"Fictitious is fine!\" />
            </p><br />  \n";
  if (isset($ValidationErrors['MASMS'])) { $SplatSlug = $RedSplat; } else { $SplatSlug = ''; }
  $TheForm .= "      <p><label for=\"MASMS\">$SplatSlug Text/SMS#:</label>
          <input type=\"text\" name=\"MASMS\" id=\"MASMS\" value=\"$MASMS\" placeholder=\"10 digits like 123 123 1234\" />
          </p>  <br />   \n";
  if (isset($ValidationErrors['MAPass'])) { $SplatSlug = $RedSplat; } else { $SplatSlug = ''; }
 $TheForm .= "
          <p><label for=\"MAPass1\">$SplatSlug Password:</label>
          <input type=\"text\" name=\"MAPass1\" id=\"MAPass1\" value=\"$MAPass1\" placeholder=\"At least 8 characters...\" />
        </p><br /> \n";
  $TheForm .= "
          <p><label for=\"MAPass2\">MAPassword, again:</label>
          <input type=\"text\" name=\"MAPass2\" id=\"MAPass2\" value=\"$MAPass2\" placeholder=\"Enter it again, please\" />
        </p><br /> \n";
 $TheForm .= "
   </fieldset>\n";
  $TheForm .= "   <fieldset><legend>Favorite College Divisions (select all )</legend>\n";
  
  $CollegeDivFile = fopen('/home/mbryant/web/CollegeDiv.txt','r');
  $FavCollegeRB ='';
  while ($ADiv = fgets($CollegeDivFile)) {
    $ADiv = trim($ADiv);
    $ADivNoSpaces = str_replace(' ','',$ADiv);  //Used to make id with no spaces so extract() will work
    if (isset($MAFavoriteCD) and $MAFavoriteCD != '' and in_array($ADiv, $MAFavoriteCD)) {
      $CheckedSlug = 'checked';
    }
     else {
      $CheckedSlug = '';
    }
   $TheForm .= "       <label for=\"Visited$ADivNoSpaces\" class=\"WideLabel\">
         <input type=\"checkbox\" name=\"MACollegeDiv[]\" id=\"Visited$ADivNoSpaces\" value=\"$ADiv\" $CheckedSlug />$ADiv
       </label>\n";
    if (isset($MAFavoriteDiv) and $ADiv == $MAFavoriteDiv) {
      $CheckedSlug = 'checked';
    } else {
      $CheckedSlug = '';
    }
    $FavCollegeRB .= "       <label for=\"Fav$ADivNoSpaces\" class=\"WideLabel\">
         <input type=\"radio\" name=\"MAFavoriteDiv\" id=\"Fav$ADivNoSpaces\" value=\"$ADiv\" $CheckedSlug />$ADiv
       </label>";
  }
  $TheForm .= "    </fieldset>
    <fieldset><legend>Favorite College division(select just one)</legend>
$FavCollegeRB
    </fieldset>";

 
  
  $TheForm .= "
    <fieldset>
      <legend>Opinions</legend>
      <div class=\"Row\">\n";
  if (isset($ValidationErrors['MAOpinion'])) { $SplatSlug = $RedSplat; } else { $SplatSlug = ''; }
  $TheForm .= "     <div class=\"Col-12\">       
          <label for=\"MAOpinion\" class=\"WideLabel\">$SplatSlug Who's your Favorite NBA Player and Why ?</label>      
            <textarea name=\"MAOpinion\" id=\"MAOpinion\" placeholder=\"Your opinion will be use to find out the most popular NBA player of all time .\">$MAOpinion</textarea>
        </div>
        </div>
      <div class=\"Row\"><br />";
             
  $TheOptions = '';
  if ($MAFavoriteBasketball == 'Nike') { $SelectedSlug = "selected"; } else { $SelectedSlug = ''; }
  $TheOptions .= "            <option value=\"Nike\" $SelectedSlug>Nike</option>\n";
  if ($MAFavoriteBasketball == 'Spadling') { $SelectedSlug = "selected"; } else { $SelectedSlug = ''; }
  $TheOptions .= "             <option value=\"Spalding\" $SelectedSlug>Spadling</option>\n";
  if ($MAFavoriteBasketball == 'Under Armour') { $SelectedSlug = "selected"; } else { $SelectedSlug = ''; }
  $TheOptions .= "             <option value=\"Under Armour\" $SelectedSlug>Under Armour</option>\n";
  if ($MAFavoriteBasketball == 'Wilson') { $SelectedSlug = "selected"; } else { $SelectedSlug = ''; }
  $TheOptions .= "             <option value=\"Wilson\" $SelectedSlug>Wilson</option>\n";
  if ($MAFavoriteBasketball == 'Baden') { $SelectedSlug = "selected"; } else { $SelectedSlug = ''; }
  $TheOptions .= "             <option value=\"Baden\" $SelectedSlug>Baden</option>";

  if (isset($ValidationErrors['MAFavoriteBasketball'])) { $SplatSlug = $RedSplat; } else { $SplatSlug = ''; }
  $TheForm .= "
        <div class=\"Col-4\">
           <label for=\"MAFavoriteBasketball\" class=\"WideLabel\">$SplatSlug  Favorite Basketball to use?</label>
           <select name=\"MAFavoriteBasketball\" id=\"MAFavoriteBasketball\" size=\"5\">
             $TheOptions
           </select>
        </div>\n";
             
  if (isset($ValidationErrors['MAShoes'])) { $SplatSlug = $RedSplat; } else { $SplatSlug = ''; }
  $TheForm .= "
        <div class=\"Col-4\">\n           <label for=\"MAShoes\" class=\"WideLabel\">$SplatSlug Favorite Basketball shoes company?</label>
             <select name=\"MAShoes\" id=\"MAShoes\" size=\"7\">\n";
  if (!isset($MAShoes)) $MAShoes = '';
  if ($MAShoes == 'Nike') { $SelectedSlug = "selected "; } else { $SelectedSlug = ''; }    	
  $TheForm .= "              <option value=\"Nike\" $SelectedSlug>Nike</option>\n";
  if ($MAShoes == 'Adidas') { $SelectedSlug = "selected "; } else { $SelectedSlug = ''; }    	
  $TheForm .= "              <option value=\"Adidas\" $SelectedSlug>Adidas</option>\n";
  if ($MAShoes == 'Under Armour') { $SelectedSlug = "selected "; } else { $SelectedSlug = ''; }    	
  $TheForm .= "              <option value=\"Under Armour\"  $SelectedSlug>Under Armour</option>\n";
  if ($MAShoes == 'Jordan') { $SelectedSlug = "selected"; } else { $SelectedSlug = ''; }
  $TheForm .= "              <option value=\"Jordan\"  $SelectedSlug>Jordan</option>\n";
  if ($MAShoes == 'Reebok') { $SelectedSlug = "selected"; } else { $SelectedSlug = ''; }
  $TheForm .= "              <option value=\"Reebok\" $SelectedSlug>Reebok</option>\n";
  if ($MAShoes == 'Puma') { $SelectedSlug = "selected"; } else { $SelectedSlug = ''; }
  $TheForm .= "              <option value=\"Puma\"  $SelectedSlug>Puma</option>\n";
  if ($MAShoes == 'New Balance') { $SelectedSlug = "selected"; } else { $SelectedSlug = ''; }
  $TheForm .= "              <option value=\"New Balance\"  $SelectedSlug>New Balance</option>
            </select>
        </div>\n";

  
  $TheOptions = '';
  $TeamsFromFile = fopen('/home/mbryant/web/NbaTeams.txt','r');
  while ($ATeam = fgets($TeamsFromFile)) {
    $ATeam = trim($ATeam);
    
    if (isset($MAFavoriteTeams) and $MAFavoriteTeams != '' and in_array($ATeams, $MAFavoriteTeams)) {
     $SelectedSlug = 'selected'; 
    } else { 
     $SelectedSlug = '';
    } 
    $TheOptions .= "             <option value=\"$ATeam\" $SelectedSlug >$ATeam</option>\n";
  }

  $TheForm .= "
        <div class=\"Col-4\">
          <label for=\"MAFavoriteTeams\" class=\"WideLabel\">Favorite NBA Teams?<br />
          <span class=\"FinePrint\">(Ctrl-click for multiple)</span></label>
          <select name=\"MAFavoriteTeams[]\" id=\"MAFavoriteTeams\" size=\"12\" multiple>
          $TheOptions
          </select>
        </div>\n";
  $TheForm .= "    </div>\n";
  $TheForm .= " </fieldset>\n";
  return $TheForm;
}

//Mod here to add UpdateMemberApp() to the sample script
function UpdateMemberApp() {
  $FormData = $_POST;
  //For this simple form we can sanitize all the FormData in a loop,
  //the second loop is to sanitize data from checkboxes and selects that return an array
  foreach ($FormData as $FieldName => $FieldValue) {
    if (is_array($FormData[$FieldName])) {
      foreach ($FormData[$FieldName] as $Elt => $EltValue) {
        $FormData[$FieldName][$Elt] = addslashes($EltValue);
      }
    } else {
      $FormData[$FieldName] = addslashes($FieldValue);
    }
  }
  extract($FormData);
  if (isset($MAId)) {
    $Verb = 'update';
    $Where = "where MAId=$MAId";
  } else {
    $Verb = 'insert into';
    $Where = '';
  }
  if (is_array($MAFavoriteCD)) {
    $MAFavoriteCD = implode('|',$MAFavoriteCD);
  }
  if (is_array($MAFavoriteTeams)) {
    $MAFavoriteTeams = implode('|',$MAFavoriteTeams);
  }
  $MAUserAgent = addslashes($_SERVER['HTTP_USER_AGENT']);
  $MAIPAddress = addslashes($_SERVER['REMOTE_ADDR']);
  $MAUserId = $_SESSION['LoginId'];
  $SQLStmt = "$Verb MembershipApps set MAName='$MAName',
                        MAUserId='$MAUserId',
                        MASMS='$MASMS',
                        MAFavoriteCollegeDiv='$MAFavoriteCD',
                        MAOpinion='$MAOpinion',
                        MAShoes='$MAShoes',
                        MAPass='$MAPass1',
                        MAFavoriteBasketball='$MAFavoriteBasketball',
                        MAFavoriteTeams='$MAFavoriteTeams',
                        MAUserAgent='$MAUserAgent',
                        MAIPAddress='$MAIPAddress'
              $Where";
 mysql_query($SQLStmt) or die("Couldn't update database with '$SQLStmt'...");
  if (isset($MAId)) {
    return $MAId;
  } else {
    $MAId = mysql_insert_id();
  }
  return $MAId;
}



//Set if initially $PoppedUp or not, then track it, used to control Close Window button
$PoppedUp = isset($_REQUEST['PoppedUp']);
if (!isset($_REQUEST['View'])) {
  $View = 'First';
} else {
  $View = $_REQUEST['View'];
}
if ($View == 'First') {
  
  $UI = "  <h2>Basketball Membership Referral</h2>
   <p>Click <a href=\"#\" onClick=\"PopupAbout()\">About the Form</a> to pop up notes about the form, JavaScript, and PHP.</p>
   <form method=\"POST\" name=\"BasketballForm\" action=\"BasketballForm.php\" onSubmit=\"return ValidateForm();\">";
  if ($PoppedUp) $UI .= "\n<input type=\"hidden\" name=\"PoppedUp\" value=\"Yep\">\n";
  $UI .= MakeTheForm('');
  $UI .= " 
     <p>Click <input type=\"submit\" name=\"View\" value=\"Submit Form\"> to submit your completed form to Basketball Memorabilia Membership.  </p>
     <p>Uncheck the box to disable JS ValidateForm: <input type=\"checkbox\" name=\"RunJS\" id=\"RunJS\" checked=\"checked\"></p>
     <p>Click <a href=\"#\" onClick=\"PopupAbout()\">About the Form</a> to pop up notes about the form, JavaScript, and PHP.</p>
</form>";
} elseif ($View == 'Submit Form') {
    
  $ValidationErrors = '';
  extract($_POST);
  
  if (!isset($MAName) or $MAName == '') $ValidationErrors['MAName'] = "Name is missing or empty.  Please enter your name before clicking Submit.";
  if (!isset($MAEmail) or $MAEmail == '') { 
    $ValidationErrors['MAEmail'] = "The email address is empty.  Please enter your email address before clicking Submit.";
  } elseif (filter_var($MAEmail, FILTER_VALIDATE_EMAIL) === false) {
    $ValidationErrors['MAEmail'] = "The email  is not a valid format.";
  }
  if (!isset($MASMS) or strlen($MASMS) < 10) $ValidationErrors['MASMS'] = "Please enter the 10-digit number where you receive text messages."; 
  if (!isset($MAOpinion) or strlen($MAOpinion) < 50) $ValidationErrors['MAOpinion'] = "Please enter in a  opinion for at least 50 characters. Your opinion helps us find out who the most popular nba player is ."; 
  if (!isset($MAFavoriteBasketball) or $MAFavoriteBasketball == '') {
    $_POST['MAFavoriteBasketball'] = '';
    $ValidationErrors['MAFavoriteBasketball'] = "Please select your least favorite basketball .";
  }
  if (!isset($MAShoes) or $MAShoes == '') $ValidationErrors['MAShoes'] = "Please select your favorite basketball shoe company";
  if (!isset($MAFavoriteTeams) or $MAFavoriteTeams  == '') $ValidationErrors['MAFavoriteTeams'] = "You must select your favorite Nba team.";

 if ((!isset($MAPass1) or $MAPass1  == '') or (!isset($MAPass2) or $MAPass2  == '')) {
    $ValidationErrors['MAPass'] = "Enter your password twice, please.";
  } elseif ($MAPass1 != $MAPass2) {
    $ValidationErrors['MAPass'] = "Passwords do not match.";
  }


  $UI = '';
  if (is_array($ValidationErrors)) {
    $ErrorCount = count($ValidationErrors);
    if ($ErrorCount == 1) {
      $UI .= "<p>Please correct this error, then click Submit Form:</p>\n";
    } else {
      $UI .= "<p>Please correct $ErrorCount errors, then click Submit Form:</p>\n";
    }
    $UI .= "<ul>\n";
    foreach ($ValidationErrors as $AnErrorMessage) {
      $UI .= "   <li>$AnErrorMessage</li>\n ";
    }
    $UI .= "</ul>\n";
  } else {
    //Mod here to call UpdateMemberApp which will return the MAId for the changed record
    $MAId = UpdateMemberApp();
    $UI .= "<p>Your form appears correct and would have been applied to the database
    if we felt like it.  You're welcome to make any corrections that might be 
    needed click Submit Form...</p>";
  }
  $UI .= "<form method=\"POST\" name=\"BasketballForm\" action=\"BasketballForm.php\" onSubmit=\"return ValidateForm();\">\n";
  $UI .= "<h2>Basketball Memorabilia Membership Referral</h2>\n";
  $UI .= MakeTheForm($ValidationErrors);
 //Mod here to stick MAId into a hidden field if it is set -- it will be empty on the original submit, is used by
  //UpdateMemberApp to determine if it needs to insert or update a record
  if (isset($MAId)) $UI .= "\n<input type=\"hidden\" name=\"MAId\" value=\"$MAId\" />";
  if ($PoppedUp) $UI .= "\n<input type=\"hidden\" name=\"PoppedUp\" value=\"Yep\" >\n";
  $UI .= " <p>Run JS ValidateForm: <input type=\"checkbox\" name=\"RunJS\" id=\"RunJS\" checked=\"checked\">  Click <input type=\"submit\" name=\"View\" value=\"Submit Form\"> if changes have been made.  </p>
     <p>Click <a href=\"#\" onClick=\"PopupAbout()\">About the Form</a> to pop up notes about the form, JavaScript, and PHP.</p>
 </form>";
  if ($PoppedUp) {
    $UI .= "<p>Click <input type=button value='Close Window' onclick='window.close()'> to close this window when you're done making changes...</p>";
  } else {
    $UI .= "<p>Use your browser's 'back button' or Alt + Left Arrow to return to the previous page...</p>";
  } 
} else {
  $UI = "<p><font color=red>! </font>Somehow we don't know what your next view should be '$View' is not valid...</p>";
} 
$FormTemplate = file_get_contents('TemplateBasketballForm.html');
$FormTemplate = str_replace('[[[LoginAdvice]]]', LoginAdvice("<a href=\"BasketballController.php\">Menu</a>"), $FormTemplate);
$FormTemplate = str_replace('[[[TheForm]]]', $UI, $FormTemplate);
echo $FormTemplate;
exit;
?>
