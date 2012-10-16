<?php

require_once dirname(__FILE__)."/labour_unlocked.php";
$labourUnlocked = new LabourUnlocked();

?>

<script type="text/javascript">
    function changeUrl(url) {
        document.getElementById('unlock-iframe').src=url;
    }
</script>


<html>
    <head>
        <title>Labour Unlocked Example Client</title>
    </head>
    <body>
        <h1>Labour Unlocked Example Client</h1>
        <p>
            <a href="javascript:void(0)" onclick="changeUrl('<?php echo $labourUnlocked->getRegisterUrl('/') ?>')">Register</a>
            <a href="javascript:void(0)" onclick="changeUrl('<?php echo $labourUnlocked->getAuthorizeUrl() ?>')">Login</a>
            <a href="javascript:void(0)" onclick="changeUrl('<?php echo $labourUnlocked->getLogoutUrl($labourUnlocked->getAuthorizeUrl()) ?>')">Logout</a>
        </p>
        <iframe id="unlock-iframe" width="900px" height="480px" src="<?php echo $labourUnlocked->getAuthorizeUrl() ?>" ></iframe>
    </body>
</html>
