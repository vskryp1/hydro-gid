<script>
    if(!window.jsvalidation){
        window.jsvalidation = {};
    }
    window.jsvalidation["<?= $validator['selector']; ?>"] = {
        rules: <?= json_encode($validator['rules']); ?>,
        ignore: "<?= isset($validator['ignore']) && is_string($validator['ignore']) ? $validator['ignore'] : null; ?>",
    };
</script>