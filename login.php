<?php
require 'header.php';
?>
<main>
    <div class="logReg">
        <section>
            <h1>Login</h1>
            <form class="loginRegister" action="./includes/login.inc.php" method="POST">
                <legend>Enter the realm</legend>
                <fieldset>
                    <a class="signUpElems"> Username <input class="signUpElems" type="text" name="userN"></a>
                    <a class="signUpElems"> Password <input class="signUpElems" type="password" name="pwd"></a>
                </fieldset>
                <button class="signUpElems" type="submit" name="loginBtn"> Enter </button>
            </form>
        </section>
    </div>
</main>

<?php
require 'footer.php';
?>