<?php
function mesEnLetras($opc)
/** Convierte el nombre del mes en el numero del mes
 *@param String $opc
 *@param Array $meses
 *return int $meses[$opc] */
{
    $meses = array(
        "enero",
        "febrero",
        "marzo",
        "abril",
        "mayo",
        "junio",
        "julio",
        "agosto",
        "septiembre",
        "octubre",
        "noviembre",
        "diciembre"
    );
    return ($meses[$opc]);
}

function mesEnNumero($opc)
/** Convierte el numero del mes en el nombre del mes
 *@param int $opc
 *@param Array $meses
 *return String $meses[$opc]
 */
{
    $meses = array(
        "enero" => 0,
        "febrero" => 1,
        "marzo" => 2,
        "abril" => 3,
        "mayo" => 4,
        "junio" => 5,
        "julio" => 6,
        "agosto" => 7,
        "septiembre" => 8,
        "octubre" => 9,
        "noviembre" => 10,
        "diciembre" => 11
    );
    $opc = strtolower($opc);
    return $meses["$opc"];
}

function inicializarProd()
/** Inicializa un Array multidimensional con lo valores de los productos mas vendidos
 * @param array $prodMasVend
 * return $prodMasVend
 */
{
    $prodMasVend[0] = array("prod" => "heladera", "precProd" => 30000, "cant" => 6);
    $prodMasVend[1] = array("prod" => "microondas", "precProd" => 15000, "cant" => 4);
    $prodMasVend[2] = array("prod" => "lavarropas", "precProd" => 17000, "cant" => 7);
    $prodMasVend[3] = array("prod" => "heladera", "precProd" => 35000, "cant" => 8);
    $prodMasVend[4] = array("prod" => "televisor", "precProd" => 30000, "cant" => 5);
    $prodMasVend[5] = array("prod" => "microondas", "precProd" => 15000, "cant" => 5);
    $prodMasVend[6] = array("prod" => "lavarropas", "precProd" => 17000, "cant" => 3);
    $prodMasVend[7] = array("prod" => "televisor", "precProd" => 17000, "cant" => 9);
    $prodMasVend[8] = array("prod" => "heladera", "precProd" => 35000, "cant" => 5);
    $prodMasVend[9] = array("prod" => "lavarropas", "precProd" => 17000, "cant" => 4);
    $prodMasVend[10] = array("prod" => "microondas", "precProd" => 15000, "cant" => 10);
    $prodMasVend[11] = array("prod" => "televisor", "precProd" => 18000, "cant" => 8);
    return $prodMasVend;
}

function inicializarVentas($prodMasVend)
/** carga un Array int con las ventas producidas en cada mes, la venta se obtiene de precProd*cant
 * @param array $ventas
 * return $ventas
 */
{
    for ($i = 0; $i < count($prodMasVend); $i++) {
        $ventas[$i] = $prodMasVend[$i]["precProd"] * $prodMasVend[$i]["cant"];
    }
    return $ventas;
}


function mesMayorMonto($ventas)
/** retorna el mes que mayor monto de ventas obtuvo 
 * @param int $mes
 * @param int $auxVentas
 * return $mes
 */
{
    $auxVentas = 0;
    $mes = 0;
    for ($i = 0; $i < count($ventas); $i++) {
        if ($ventas[$i] > $auxVentas) {
            $auxVentas = $ventas[$i];
            $mes = $i;
        }
    }
    return $mes;
}


function superaMonto($ventas, $monto)
/** verifica cual es el mes que supera el monto de ventas que el valor ingresado por el usuario
 * @param array $ventas
 * @param int $monto
 * @param boolean $aux
 * @param int $i
 * return $i
 */
{
    $aux = true;
    $i = 0;
    while (($i < count($ventas)) && $aux) {
        if (($ventas[$i] >= $monto)) {
            $aux = false;
        } else {
            $i++;
        }
    }
    return $i;
}

function ordenamiento($a, $b)
/***/
{
    return $b["precProd"] - $a["precProd"];
}

function selecProducto()
/** Selecciona producto vendido
 * @param int $opc
 * @param String $prod
 * return $prod
 */

{
    $valido = false;
    while (!$valido) {
        echo "Seleccione un producto \n";
        echo "1- Lavarropas \n";
        echo "2- Microondas \n";
        echo "3- Heladera \n";
        echo "4- Televisor \n";
        $opc = trim(fgets(STDIN));
        switch ($opc) {
            case 1:
                $prod = "Lavarropas";
                $valido = true;
                break;
            case 2:
                $prod = "Microondas";
                $valido = true;
                break;
            case 3:
                $prod = "Heladera";
                $valido = true;
                break;
            case 4:
                $prod = "Televisor";
                $valido = true;
                break;
            default:
                echo "producto no valido \n";
        }
    }
    return $prod;
}

function verificarProducto($prodMasVend, $nuevaVenta)
/** Verifica si el producto de la nueva venta tiene mayor monto de venta si es true actualiza el producto mas vendido de ese mes.
 * return $prodMasVend
 */
{
    $mes = $nuevaVenta["mes"];
    if (($prodMasVend[$mes]["precProd"] * $prodMasVend[$mes]["cant"]) < ($nuevaVenta["precio"] * $nuevaVenta["cant"])) {
        $prodMasVend[$mes]["prod"] = $nuevaVenta["producto"];
        $prodMasVend[$mes]["precProd"] = $nuevaVenta["precio"];
        $prodMasVend[$mes]["cant"] = $nuevaVenta["cant"];
    }
    return $prodMasVend;
}
function datosNuevaVenta()
/** Solicita al usuario los datos de la nueva venta
 * @param int $mes
 * @param String $prod
 * @param int $precio
 * @param int $cant
 * @param array $nuevaVenta
 * return $nuevaVenta
 */
{
    $mes = solicitarMes();
    $prod = selecProducto();
    echo "ingrese precio y cantidad \n";
    $precio = trim(fgets(STDIN));
    $cant = trim(fgets(STDIN));
    $nuevaVenta = array(
        "mes" => $mes,
        "producto" => $prod,
        "precio" => $precio,
        "cant" => $cant
    );
    return $nuevaVenta;
}
function actualizarVenta($nuevaVenta, $ventas)
/** Actualiza el monto de ventas sumando el valor de la nueva venta
 * @param int $monto
 * * return $ventas
 */
{
    $monto = $nuevaVenta["precio"] * $nuevaVenta["cant"];
    $ventas[$nuevaVenta["mes"]] += $monto;
    return $ventas;
}

function solicitarMes()
{
    $valido = false;
    while (!$valido) {
        echo "Ingresar Mes: \n";
        echo "1- en numero(1-12)\n";
        echo "2- en letras(enero-diciembre)\n";
        $respuesta = trim(fgets(STDIN));


        switch ($respuesta) {
            case 1:
                while (!$valido) {
                    echo "Ingrese un mes: ";
                    $mes = trim(fgets(STDIN));
                    if (
                        $mes == 1 || $mes == 2 || $mes == 3 || $mes == 4 || $mes == 5 || $mes == 6
                        || $mes == 7 || $mes == 8 || $mes == 9 || $mes == 10 || $mes == 11 || $mes == 12
                    ) {
                        $valido = true;
                        $mes -= 1;
                    } else {
                        echo "Mes incorrecto.\n";
                    }
                }
                break;
            case 2:
                while (!$valido) {
                    echo "Ingrese un mes: ";
                    $mes = trim(fgets(STDIN));
                    $mes = strtolower($mes);
                    if (
                        $mes == "enero" || $mes == "febrero" || $mes == "marzo" || $mes == "abril" || $mes == "mayo" || $mes == "junio"
                        || $mes == "julio" || $mes == "agosto" || $mes == "septiembre" || $mes == "octubre" || $mes == "noviembre" || $mes == "diciembre"
                    ) {
                        $valido = true;
                        $mes = mesEnNumero($mes);
                    } else {
                        echo "Mes incorrecto.\n";
                    }
                }
                break;
            default:
                echo "respuesta incorrecta";
                break;
        }
    }


    return $mes;
}

function informacionCompleta($mes, $prodMasVend, $ventas)
{
    print("<" .  mesEnLetras($mes) . "> \n");
    print_r("el producto con mayor monto de ventas: " . $prodMasVend[$mes]["prod"] . "\n");
    print_r("cantidad de productos vendidos: " . $prodMasVend[$mes]["cant"] . "\n");
    print_r("precio unitario: " . $prodMasVend[$mes]["precProd"] . "\n");
    print_r("precio total de ventas del producto: " . $prodMasVend[$mes]["precProd"] * $prodMasVend[$mes]["cant"] . "\n");
    print_r("monto acumulado de ventas del mes: " . $ventas[$mes] . "\n");
}

function menuOpcionesAux()
/** Muestra las opciones disponibles del menu
 * @param int $opcion
 * return $opcion
 */
{
    echo "Menu: \n";
    echo "1) Ingresar una venta  \n";
    echo "2) Mes con mayor monto de ventas \n";
    echo "3) Primer mes que supera un monto de ventas \n";
    echo "4) Informacion de un mes \n";
    echo "5) Productos mas vendidos Odenados\n";
    echo "0) Salir del menu \n";
    echo "Ingrese una opcion: \n";
    $opcion =  trim(fgets(STDIN));
    return $opcion;
}

function menuOpciones($prodMasVend, $ventas)
{
    do {
        $opcion = menuOpcionesAux();
        switch ($opcion) {
            case 0:
                echo "Usted salio del menu";
                break;
            case 1:;
                //ingresar venta en un mes determinado
                $nuevaVenta = datosNuevaVenta();
                $prodMasVend = verificarProducto($prodMasVend, $nuevaVenta);
                $ventas = actualizarVenta($nuevaVenta, $ventas);
                break;
            case 2:
                //Mes con mayor monto de ventas
                $mes = mesMayorMonto($ventas);
                echo "Mes con mayor monto de ventas: \n";
                informacionCompleta($mes, $prodMasVend, $ventas);
                break;
            case 3:
                //Primer mes que supera un monto(ingresado por usuario) de ventas
                echo "Ingrese el monto ";
                $monto = trim(fgets(STDIN));
                $mes = superaMonto($ventas, $monto);
                if ($mes < count($ventas)) {
                    $mesL = mesEnLetras($mes);
                    print_r("El mes que supera el monto " . $monto . " es: " . $mesL . "\n");
                } else {
                    echo "Ningun mes supera el monto";
                }

                break;
            case 4:
                //Muentra informacion de un mes ingresado
                $mes = solicitarMes();
                informacionCompleta($mes, $prodMasVend, $ventas);
                break;
            case 5:
                //productos mas vendidos ordenados
                uasort($prodMasVend, 'ordenamiento');
                print_r($prodMasVend);
                break;
            default:
                echo "Opcion invalida, ingrese una opcion valida \n";
                break;
        }
    } while ($opcion != 0);
}

function main()
{
    $prodMasVend = inicializarProd();
    $ventas = inicializarVentas($prodMasVend);
    menuOpciones($prodMasVend, $ventas);
}

main();
