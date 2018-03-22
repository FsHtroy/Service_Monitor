<?php
    include_once '../Models/Server.php';
    // New Object Here
    $server_CA1 = new Server('0.0.0.0', 'US-CA1',Array(22, 80, 6000), Array('SSH', 'Web', 'ShadowSocks'));
    $server_CA2 = new Server('1.1.1.1', 'US-CA2',Array(21, 22, 80,6000), Array('FTP', 'SSH', 'Web', 'ShadowSocks'));

    // Set Group Here
    $group_US = Array($server_CA1, $server_CA2);

    switch ($_GET['group']) {
        // Add Group Case Here
        case 1:
            check($group_US);
            break;
    }

    function check($group) {
        foreach ($group as $check_server) {
            $portList = $check_server->getCheckPort();
            $serviceId = 0;
            foreach ($portList as $port) {
                $rs = $check_server->checkServer($port);
                if ($rs) {
                    $check_server->setServiceStatus('Online', $serviceId);
                } else {
                    $check_server->setServiceStatus('Offline', $serviceId);
                }
                $serviceId++;
            }
        }
        echo json_encode($group);
    }