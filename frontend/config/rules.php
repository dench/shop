<?php
return [
    $params['images_dir'] . '/<dir:[a-zA-Z0-9-_\/]+>/<action:(small|medium|large)>/<name:[a-zA-Z0-9-_\.]+>' => 'image/<action>',
    $params['files_dir'] . '/<dir:[a-zA-Z0-9-_\/]+>/<name:[a-zA-Z0-9-_\.]+>' => 'file/open',
];