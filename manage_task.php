<?php
    include "top.php";
    include ('login.php');
    include "header.php";
    include "nav.php";
?>

<article>

    <form action="/cs148/assignment10/register.php"
          method="post"
          id="frmRegister">
        <fieldset id="Make-a-Task">
            
            <label for="lstCategory">Category
                <select id="lstCategory"
                        name="lstCategory"
                        tabindex="100" >
                    
                    <option value="HW">Home Work</option>
                    <option value="Chores">Chores</option>
                    <option value="Obligations" >Obligations</option>
                    <option value="Personal" >Personal</option>
                    <option value="Doctor" >Doctor</option>
                    <option value="" selected>Other</option>
            
                </select>
                
            </label>
            
            <label for="txtBox">Details/Description (optional)
                <input type="text" id="txtDetails" name="txtDetails"
                       value="<?php print $details ?>"
                       tabindex="100" maxlength="45" placeholder="here you can write the details of your task. For example, if the task is go grocery shopping, you could write out your shopping list here!"
                           <?php if ($detailsERROR) print 'class="mistake"'; ?>
                           onfocus="this.select()"
                       >
                
                
            </label>
            
            
            
        </fieldset>
    </form>

</article>

<?php
include ('footer.php');
?>


</body>
</html>