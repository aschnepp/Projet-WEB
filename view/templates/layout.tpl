{* smarty *}
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>{block name=title}Default Page Title{/block}</title>
    {block name=head}{/block}
</head>

<body>
    {block name=body}

    {/block}
</body>

{* Script service worker PWA *}
<script>
if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register('../PWA/service-worker.js')
}
</script>

</html>