<?php
require(dirname(pathinfo(__FILE__, PATHINFO_DIRNAME)) . "/SiteSettings.php" );
AllowLoggedIn();
$Cnxn = mysql_connect('localhost', '2017Winter', 'Winter2018');
if (!$Cnxn) {
  print "Unable to connect to the MySQL server at this time...";
  exit;
}
$DB = mysql_select_db('2017Winter', $Cnxn);
if (!$DB) {
  print "Unable to select the 2017Winter database at this time...";
  exit;
}


$SQLStmt = "select ItemDescription, round(ItemPrice,2) as Price from Items join Details on ItemId=DItemId      join Orders on DOId=OId where ItemOriginalOrgId=606 and OStatus='Fulfilled' group by ItemId order by ItemDescription Limit 5 ; "; 
$MAResults = mysql_query($SQLStmt) or die("Can't do '$SQLStmt'...");
$MACount = mysql_num_rows($MAResults);
if ($MACount == 0) {
  $UI = "<h2>Nothing to report...</h2>\n";
} else {
  $UI = "<h2>Recent Comissions Earned</h2>\n";
  if ($MACount == 1) {
    $UI .= "There is one commissions to pay at " . date('H:i Y-m-d') . ':';
  } else {
    $UI .= "There are $MACount commissions to pay at " .  date('H:i Y-m-d') . ':';
  }
  $UI .= "\n\n<br /><br />\n<div class=\"Row Centering\">\n<table class=\"Centered\">\n";
  $UI .= "   <tr class=\"Bottom1px\" valign=\"top\" ><th>Item Orginiated By</th>
      <th align=\"left\">Customer</th>
      <th align=\"left\">Item Purchased</th>
       <th align=\"center\">Price</th>
       <th align=\"center\">Comissions</th>
   </tr>\n";
  while ($AMA = mysql_fetch_assoc($MAResults)) {
    foreach($AMA as $Key  => $Value) {
      $AMA[$Key] = htmlspecialchars($Value);
    }
    extract($AMA);
    $MAFavoriteTeams = str_replace('|','<br />',$MAFavoriteTeams);
    $UI .= "   <tr valign=\"top\" ><td class=\"AlphaData Bottom1px\" >$OrgName<br /></td>
      <td class=\"AlphaData Bottom1px\">$Customer</td>
      <td class=\"AlphaData Bottom1px\">$ItemDescription </td>
      <td class=\"AlphaData Bottom1px\">$Price</td>
      <td class=\"AlphaData Bottom1px\">$Comissions</td>
      <td class=\"AlphaData Bottom1px\"></td>


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
