<?php
    include( GetHeaderFile() );
?>
<!-- Start main content here -->

<div class="centerText mainCategory">
    <h1 class="goldText">Welcome</h1>

    <p>Welcome to the Clarion University foreign language placement site.</p>

    <p>
        The following examination will help us better understand your knowledge of foreign languages.
        <br />
        The information provided by this exam will help determine what language courses
        <br />
        you will need to take upon enrollment at Clarion University.
    </p>
    
    <p>Thank you for your time.</p>

    <p>Good luck!</p>

    <input type="button" onclick="Relocate('<?php echo(GetControllerScript(GetExamControllerFile(), GetEnterKeyCodeAction())); ?>');" value="Start Exam" />
    
    <br />
    
    <br />
</div>
<!-- End main content here -->
<?php
    include( GetPlainFooterFile() ); 
?>