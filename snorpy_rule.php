<html>
    <title>Snorpy 2.0 - Web Based Snort Rule Creator</title>
    <link rel='stylesheet' href='./css/snorpy.css' type='text/css'></link>
    <link rel="stylesheet" href="./css/jquery-ui.css"></link>
    <meta charset="UTF-8">
    <meta name="description" content="Free web based snort rule creator, maker, with jquery">
    <meta name="keywords" content="web,based,snort,rule,creator,maker,builder">
    <meta name="author" content="Christopher Davis">

    <body>
    <?php
    set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib/');
    include('Net/SSH2.php');
    include('Crypt/RSA.php');
    $key = new Crypt_RSA();
    $ssh = new Net_SSH2('10.8.0.6',22);
    $key->loadKey(file_get_contents('sshpri.ppk'));
    if (!$ssh->login('pi', $key)) {
    exit('Login Failed');
    // $name = $action = $protocol = $sourceip = $srcport = "";
    if (isset($_POST['manual'])) {
        $manual = $_POST["manual"];
        echo $ssh->exec("echo raspberry | sudo python add_rule.py " .$manual." \n");
    }
    if (isset($_POST['action'])) {
        $action = $_POST["action"];
        if (isset($_POST['protocol'])) {
            $protocol = $_POST["protocol"];
            if($protocol=='ip'){
                $sourceip = $_POST["sourceip"];
                $dstip = $_POST["dstip"];
                $sid = $_POST["sid"];
                $rev = $_POST["rev"];
                $headermessage = $_POST["headermessage"];
                $classtype = $_POST["classtype"];
                $priority = $_POST["priority"];
                $gid = $_POST["gid"];
                $a = String($action." ".$protocol." ".$sourceip." -> ".$dstip." ( msg:\"".$headermessage."\"; classtype:".$classtype."; "
        .$priority."; gid:".$gid."; sid:".$sid."; rev:".$rev."; )");
        echo $a;
            }elseif($protocol=='icmp'){
                $sourceip = $_POST["sourceip"];
                $dstip = $_POST["dstip"];
                $sid = $_POST["sid"];
                $rev = $_POST["rev"];
                $headermessage = $_POST["headermessage"];
                $classtype = $_POST["classtype"];
                $priority = $_POST["priority"];
                $gid = $_POST["gid"];
                echo $action." ".$protocol." ".$sourceip." -> ".$dstip." ( msg:\"".$headermessage."\"; classtype:".$classtype."; "
        .$priority."; gid:".$gid."; sid:".$sid."; rev:".$rev."; )";
            }elseif($protocol=='tcp'){
                $sourceip = $_POST["sourceip"];
                $srcport = $_POST["srcport"];
                $dstip = $_POST["dstip"];
                $dstport = $_POST["dstport"];
                $sid = $_POST["sid"];
                $rev = $_POST["rev"];
                $headermessage = $_POST["headermessage"];
                $classtype = $_POST["classtype"];
                $priority = $_POST["priority"];
                $gid = $_POST["gid"];
                echo $action." ".$protocol." ".$sourceip." ".$srcport." "." -> ".$dstip." ".$dstport." ( msg:\"".$headermessage."\"; classtype:".$classtype."; "
        .$priority."; gid:".$gid."; sid:".$sid."; rev:".$rev."; )";
            }elseif($protocol=='udp'){
                $sourceip = $_POST["sourceip"];
                $srcport = $_POST["srcport"];
                $dstip = $_POST["dstip"];
                $dstport = $_POST["dstport"];
                $sid = $_POST["sid"];
                $rev = $_POST["rev"];
                $headermessage = $_POST["headermessage"];
                $classtype = $_POST["classtype"];
                $priority = $_POST["priority"];
                $gid = $_POST["gid"];
                echo $action." ".$protocol." ".$sourceip." ".$srcport." "." -> ".$dstip." ".$dstport." ( msg:\"".$headermessage."\"; classtype:".$classtype."; "
        .$priority."; gid:".$gid."; sid:".$sid."; rev:".$rev."; )";
            }else{

            }
        }else{
            
        }
    }

    ?>
</body>
    <script src="./js/particles.js"></script>
    <script src="./js/part.js"></script>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/jquery-ui.js"></script>
    <script src="./js/snorpy.js"></script>
</html>