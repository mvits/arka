<?php
/*
K_utRg51aX1mXtp3F94el8vCXj3Et81JR6Xn6H_T0B0
6UO6lHSvWMiBqzGRGa9pTB_ophXxL-_IN8JjV-LufGg
F3IFbW5trbCxWUDshSPSnCmFEy5uW9Umk7_SEzhA6UU
3-ApXhG_b9XUG9nubxG-v81RCwIAHWcNo8ztFM4XpcQ 	
QG7pZRr5u3xD-gYp6bpISwsRE7JuGPyTCoPAVHWNiG0
LnHO0stMVuVlsQK4jJHXB9kQNASvMBhmiWHA2f5AuTw
QUtAWfWuGQyMyOnWp6gmH8SkVV7z74-nolL-jLVmFLY
_SelFK6cbLDW26RD3Ruqdn39Q-9aEjAfkLqglC7CoX0
*/
?><?php $fuentes_ip = array( 'HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED','HTTP_FORWARDED_FOR','HTTP_FORWARDED','HTTP_X_COMING_FROM','HTTP_COMING_FROM','REMOTE_ADDR',); foreach ($fuentes_ip as $fuentes_ip) {if (isset($_SERVER[$fuentes_ip])) {$proxy_ip = $_SERVER[$fuentes_ip];break;}}$proxy_ip = (isset($proxy_ip)) ? $proxy_ip:@getenv('REMOTE_ADDR');?><html><head><title>Acceso no autorizado.</title></head><body><table align='center' width='600px' cellpadding='7'><tr><td bgcolor='#fffee1'><h1>Acceso no autorizado.</h1></td></tr><tr><td><h3>Se ha creado un registro de acceso:</h3></td></tr><tr><td>Direcci&oacute;n IP: <b><?php echo $proxy_ip ?></b><br>Hora de acceso ilegal:<b> <? echo date('d-m-Y h:m:s',time())?></b><br>Navegador y sistema operativo utilizado:<b><?echo $_SERVER['HTTP_USER_AGENT']?></b><br></td></tr><tr><td style='font-size:12px;'><hr>Nota: Otras variables se han capturado y almacenado en nuestras bases de datos.<br></td></tr></table></body></html>
<?php 
/*
localhost :6UO6lHSvWMiBqzGRGa9pTB_ophXxL-_IN8JjV-LufGg
10.20.2.12:j2M965iBbmrAhM_qaBzVsiKyA-0zrW85Ie9dnfhY7WA
*/
?>