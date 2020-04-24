<?php

$ack = "I'm the acknowledgment.";
/* THIS IS A HEREDOC STRING WHICH CREATES THE FORM  */
$form = <<<HTML
    <form method="post" action="index.php">
    <div class="form-group">
      
   
  </form>
HTML;

/* HERE I RETURN AN ARRAY THAT CONTAINS AN ACKNOWLEDGEMENT AND THE FORM.  THIS IS DISPLAYED ON 
THE INDEX PAGE. */
return [$ack, $form];

?>