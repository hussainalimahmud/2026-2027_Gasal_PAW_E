
<h1>Register</h1>

<form action="form.php" method="POST">
    <fieldset style="background-color:#e0e0ff">
        <legend>Person Details</legend>

        <div class="field">
            <label for="surname">Surname</label>
            <input type="text" name="surname" id="surname"
                size="31"
                value="<?php echo htmlspecialchars($_POST['surname'] ?? ''); ?>">
        </div>

        <div class="field">
            <label for="email">Email address</label>
            <input type="text" name="email" id="email" size="31"
                value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
        </div>

        <div class="field">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" size="31">
        </div>

        <div class="field">
            <label for="address">Street Address</label>
            <textarea name="address" id="address"
                rows="3" cols="22"><?php
                echo htmlspecialchars($_POST['address'] ?? '');
            ?></textarea>
        </div>

        <div class="field">
            <label for="state">State</label>
            <select name="state" id="state">
                <option value="-1">Choose your state</option>
                <option value="1">Australian Capital Territory</option>
                <option value="2">Queensland</option>
                <option value="3">Victoria</option>
                <option value="4">New South Wales</option>
                <option value="5">Tasmania</option>
                <option value="6">South Australia</option>
                <option value="7">Western Australia</option>
                <option value="8">Northern Territory</option>
            </select>
        </div>

        <input type="hidden" name="country" value="Australia">

        <div class="field">
            <label>Gender</label>
            <input type="radio" name="sex" value="male" id="male">
            <label for="male" style="width:auto">Male</label>

            <input type="radio" name="sex" value="female" id="female">
            <label for="female" style="width:auto">Female</label>
        </div>

        <div class="field">
            <label for="vegetarian">Vegetarian?</label>
            <input type="checkbox" name="vegetarian"
                id="vegetarian" value="Yes">
        </div>

        <div class="field">
            <label></label>
            <input type="submit" name="submit" value="Submit">
            <input type="reset" name="reset" value="Reset">
        </div>
    </fieldset>
</form>
