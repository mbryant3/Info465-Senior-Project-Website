<?php
require(dirname(pathinfo(__FILE__, PATHINFO_DIRNAME)) . "/SiteSettings.php" );
AllowLoggedIn();
$SQLStmt = "select MAName, MAUserId, MASMS, MAShoes, MAFavoriteBasketball, MAOpinion, MAFavoriteTeams,MAFavoriteDiv ,MAFavoriteCollegeDiv
	    from MembershipApps
	    order by MAId desc ";
$MAResults = mysql_query($SQLStmt) or die("Can't do '$SQLStmt'...");
$MACount = mysql_num_rows($MAResults);
if ($MACount == 0) {
  $UI = "<h2>Nothing to report...</h2>\n";
} else {
  $UI = "<h2>Recent Applicants</h2>\n";
  if ($MACount == 1) {
    $UI .= "There is one applicant at " . date('H:i Y-m-d') . ':';
  } else {
    $UI .= "There are $MACount applicants at " .  date('H:i Y-m-d') . ':';
  }
  $UI .= "\n\n<p>Click <a href=\"BasketballForm.php\">Membership Application</a> to enter another membership application.</p>";
  $UI .= "\n\n<br /><br />\n<div class=\"Row Centering\">\n<table class=\"Centered\">\n";
  $UI .= "   <tr class=\"Bottom1px\" valign=\"top\" ><th>Name/Entered By</th>
      <th align=\"center\">Favorite Shoes</th>
      <th align=\"center\">Favorite Basketball</th>
       <th align=\"center\">Favorite NBA teams</th>
   </tr>\n";
  while ($AMA = mysql_fetch_assoc($MAResults)) {
    foreach($AMA as $Key  => $Value) {
      $AMA[$Key] = htmlspecialchars($Value);
    }
    extract($AMA);
    $MAFavoriteTeams = str_replace('|','<br />',$MAFavoriteTeams);
    $UI .= "   <tr valign=\"top\" ><td class=\"AlphaData Bottom1px\" >$MAName<br />$MAUserId</td>
      <td class=\"AlphaData Bottom1px\">$MAShoes</td>
      <td class=\"AlphaData Bottom1px\">$MAFavoriteBasketball</td>
      <td class=\"AlphaData Bottom1px\">$MAFavoriteTeams</td>

   </tr>\n
   ";
  }
  $UI .= "</table>\n</div>\n\n<br /><br /><p>This is an incomplete listing, please show more...</p>";
}
$FormTemplate = file_get_contents('TemplateBasketballForm.html');
$FormTemplate = str_replace('[[[LoginAdvice]]]', LoginAdvice("<a href=\"BasketballController.php\">Menu</a> "), $FormTemplate);
$FormTemplate = str_replace('[[[TheForm]]]', $UI, $FormTemplate);
echo $FormTemplate;
exit;
?>
