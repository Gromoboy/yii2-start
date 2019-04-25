warning: LF will be replaced by CRLF in models/User.php.
The file will have its original line endings in your working directory
[1mdiff --git a/models/User.php b/models/User.php[m
[1mindex bba1275..31300b8 100644[m
[1m--- a/models/User.php[m
[1m+++ b/models/User.php[m
[36m@@ -11,6 +11,7 @@[m [mclass User extends \yii\base\BaseObject implements \yii\web\IdentityInterface[m
     public $password;[m
     public $authKey;[m
     public $accessToken;[m
[32m+[m[32m    public $email;[m
 [m
 //    private static $users = [[m
 //        '100' => [[m
