<?php echo 'if you want to serve XHTML or XML documents, do it like this'; ?>

<script language="php">
        echo 'some editors (like FrontPage) don\'t
              like processing instructions';
</script>

<? echo 'this is the simplest, an SGML processing instruction'; ?>
<?= expression ?> This is a shortcut for "<? echo expression ?>"

<% echo 'You may optionally use ASP-style tags'; %>
<%= $variable; # This is a shortcut for "<% echo . . ." %>