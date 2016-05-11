<?php
    $this->title = 'Server tests';
?>
<div class="test-server">

    <form action="#" method="post">
        <label>
            <input type="checkbox" name="debug" value="debug">show debug output
        </label>
        
        <label>
            <input type="checkbox" name="codeCoverage" value="true">with code coverage (10 times slower)
        </label>
        
        <button name="run">Run Tests</button>
    </form>

    <a href="<?php echo $codeCoverageUrl; ?>">see code coverage</a>

    <?php if ( isset($_POST['run']) ) { ?>
    
        <h3> Return code is <?php echo $return_var;?></h3>

        <?php if ($htmlFilePath !== false) { ?>
            <iframe id="iframe"src="report" onload="setHeight(); setOnClickListener();" ></iframe>
        <?php } else { ?>
    
            <pre>
            <?php
                foreach($output as $line) {
                    echo yii\helpers\Console::ansiToHtml($line) . "\n";
                }
            ?>
            </pre>
            
        <?php } ?>
        
    <?php } ?>
</div>

<script type="text/javascript">
    function onClickListener()
    {
        setHeight();
    }

    function setHeight()
    {
        var iframe = document.getElementById("iframe");
        iframe.style.height = iframe.contentDocument.body.scrollHeight + 'px';
    }
    
    function setOnClickListener()
    {
        document.getElementById("iframe").contentWindow.document.body.addEventListener('click', onClickListener);
    }
</script>

