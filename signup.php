<?php
require 'header.php';
?>
<main>
    <div>
        <section class="logReg">
            <h1>Signup</h1>
            <form class="loginRegister" action="./includes/signup.inc.php" method="POST">
                <legend>Create Account</legend>
                <fieldset>
                    <a class="signUpElems"> Username <input class="signUpElems" type="text" name="userN"> </a>
                    <a class="signUpElems"> Password <input class="signUpElems" type="password" name="pwd"></a>
                    <a class="signUpElems"> Repeat Password <input class="signUpElems" type="password" name="pwdR"></a>
                </fieldset>
                <button class="signUpElems" type="submit" name="submtBtn"> Signup </button>
            </form>
        </section>
    </div>
</main>

<?php
require 'footer.php';
?>