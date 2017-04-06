<code><?php echo "Message:" .  $msg;?></code>


<code>
<?php if($upload_data != ''):?>
<?php var_dump($upload_data);?>

</code>


<?php endif;?>

<?php echo form_open_multipart('Receipt/upload_it');?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>