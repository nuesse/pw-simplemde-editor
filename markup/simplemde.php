<?php namespace Processwire;
/**
 * Created by PhpStorm.
 * User: Abdus
 * Date: 10.01.2017
 * Time: 21:25
 */
?>
    <div id="<?php echo $editorId ?>-container">
        <textarea <?php echo $attrs ?> ><?php echo $value ?></textarea>
    </div>
    <script>
        (function () {
            var editorId = '<?php echo $editorId ?>';
            var customConfigJson = '<?php echo $customConfig ?>';

            var opts = {};

            if (customConfigJson) {
                try {
                    opts = JSON.parse(customConfigJson);

                    // add highlighter js
                    if (opts.renderingConfig
                        && opts.renderingConfig.codeSyntaxHighlighting) {

                        var script = document.createElement('script');
                        var link = document.createElement('link');
                        script.src = 'https://cdn.jsdelivr.net/highlight.js/latest/highlight.min.js';
                        link.href = 'https://cdn.jsdelivr.net/highlight.js/latest/styles/github.min.css';
                        link.rel = 'stylesheet';
                        link.type = 'text/css';

                        document.head.appendChild(script);
                        document.head.appendChild(link);
                    }
                } catch (e) {
                    console.log(e.message);
                }
            }

            opts.element = document.getElementById(editorId);

            var simplemde = new SimpleMDE(opts);
        })();
    </script>


<?php if ($monospaced): // monospaced font for the editor ?>
    <style>
        #<?php echo $editorId ?>-container {
            font-family: Monaco, Consolas, 'Andale Mono', 'Ubuntu Mono', monospace;
        }
    </style>
<?php endif; ?>