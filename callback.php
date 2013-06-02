<?php

if (!isset($_POST)) {
    exit(404);
}

require_once('includes/cnx.php');
require_once('includes/fpdf17/fpdf.php');
require_once('includes/funciones.php');
require_once("includes/PHPMailer_5.2.1/class.phpmailer.php");

class PDF extends FPDF {

// Pie de página
    function Footer() {
        $this->Image('images/footerRSA.png', 0, 294, 210);
    }

    function ImprovedTable($header, $data) {
        // Header

        $this->SetFont('Arial', '', 10);
        $this->Cell(150, 7, $header, 1, 0, 'C');
        $this->Ln();
        // Data
        $this->SetFont('Arial', '', 12);

        foreach ($data as $row) {
            foreach ($row as $col)
                $this->Cell(75, 6, iconv('UTF-8', 'windows-1252', $col), 1, 0, 'C');
            $this->Ln();
        }
    }

    function BasicTable($header, $data) {
        // Header
        foreach ($header as $col)
            $this->Cell(40, 7, iconv('UTF-8', 'windows-1252', $col), 1);
        $this->Ln();
        // Data
        foreach ($data as $row) {
            foreach ($row as $col)
                $this->Cell(40, 6, iconv('UTF-8', 'windows-1252', $col), 1);
            $this->Ln();
        }
    }

}

$date = $_POST["date"];
$user_id = $_POST["user_id"];
$transaction_id = $_POST["transaction_id"];
$product_id = $_POST["product_id"];
$currency = $_POST["currency"];
$product_description = $_POST["product_description"];
$payment_method = $_POST["payment_method"];
$dev_reference = $_POST["dev_reference"];

header('x', true, 200);

$sql = "select count(*) as total from transacciones where transaction_id = '{$transaction_id}'";
$res = mysql_query($sql) or die(mysql_error());

while ($fila = mysql_fetch_assoc($res)) {
    $existen = $fila["total"];
}

if ($existen == 0) {

    $sql = "INSERT INTO transacciones (date,date_mentez,user_id,transaction_id,product_id,currency,product_description,payment_method,dev_reference)
                            VALUES (now(),'{$date}','{$user_id}','{$transaction_id}','{$product_id}','{$currency}','{$product_description}','{$payment_method}','{$dev_reference}')";
    mysql_query($sql);


//Para cada item contenido dentro de dev_products

    $sql = "select id, plazo from dev_products_items where id_dev_products = '{$dev_reference}'";
    $resitem = mysql_query($sql) or die(mysql_error());

    while ($filaitem = mysql_fetch_assoc($resitem)) {

        $id_item = $filaitem["id"];
        $plazo = $filaitem["plazo"];

        $sql = "select LPAD(max(id)+1,8,'0') as npoliza from sec_poliza";
        $res = mysql_query($sql) or die(mysql_error());
        while ($fila = mysql_fetch_assoc($res)) {
            $npoliza = $fila["npoliza"];
        }
        $sql = "insert into sec_poliza (id_dev_products_item, npoliza, fecha, usr_id) values ('{$id_item}', '{$npoliza}',now(),'{$user_id}')";
        mysql_query($sql);

        $sql = "select LPAD(dev_products_items.id,10,'0') as idlong,dev_products_items.email, dev_products_items.name, dev_products_items.apellido, 
CONCAT(LEFT(dev_products_items.name,24), ' ',  LEFT(dev_products_items.apellido,25)) as namelong, LEFT(dev_products_items.direccion,50) as addrlong,
LEFT(dev_products_items.barrio,20) as barriolong, LEFT(dev_products_items.ciudad,20) as ciudadlong, LEFT(dev_products_items.estado,2) as estadolong,
LEFT(dev_products_items.cep,8) as ziplong, LEFT(dev_products_items.telefono,11) as telefonolong, LEFT(dev_products_items.sexo,1) as legallong, 
LEFT(dev_products_items.cpf,14) as cedulalong,LEFT(dev_products_items.referencia,50) as referencialong, LPAD(dev_products_items.precioprod,11,'0') as precioprod,
LPAD(dev_products_items.precio,11,'0') as preciolong, date_format(dev_products_items.datecompra,'%Y%m%d') as datecompra, date_format(dev_products_items.datefactura,'%Y%m%d') as datefactura, 
LPAD(dev_products_items.plazo,2,'0') as plazolong, LEFT(dev_products_items.notafiscal,20) as notafiscallong, descrip
from dev_products_items where id = $id_item";

        $res = mysql_query($sql) or die(mysql_error());

        while ($fila = mysql_fetch_assoc($res)) {
            $idusr_long = $fila["idlong"];
            $namelong = $fila["namelong"];
            $addrlong = $fila["addrlong"];
            $barriolong = $fila["barriolong"];
            $ciudadlong = $fila["ciudadlong"];
            $estadolong = $fila["estadolong"];
            $legallong = $fila["legallong"];
            $cedulalong = $fila["cedulalong"];
            $ziplong = $fila["ziplong"];
            $telefonolong = $fila["telefonolong"];
            $nombres = $fila["name"];
            $apellidos = $fila["apellido"];
            $email = $fila["email"];
            $referencialong = $fila["referencialong"];
            $precioprod = $fila["precioprod"];
            $preciolong = $fila["preciolong"];
            $datecompra = $fila["datecompra"];
            $datefactura = $fila["datefactura"];
            $plazolong = $fila["plazolong"];
            $notafiscallong = $fila["notafiscallong"];
            $descrip = $fila["descrip"];
        }

// Creación del objeto de la clase heredada
        $pdf = new PDF();
        $pdf->AliasNbPages();

        $pdf->AddPage();
        $pdf->SetLeftMargin(30);
        $pdf->SetRightMargin(30);
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetDrawColor(51, 51, 153);
        $pdf->Image('images/logoRSA.png', 160, 8, 20);
        $pdf->Cell(50, 10, iconv('UTF-8', 'windows-1252', 'Certificado nº ') . $npoliza, 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Ln();
        $pdf->MultiCell(0, 5, iconv('UTF-8', 'windows-1252', 'CERTIFICADO DO SEGURO ROUBO OU FURTO QUALIFICADO DE PORTÁTEIS'), 0, 'C', 0);
        // Salto de línea
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 12);
        $texto = 'Certificamos que ' . strtoupper($nombres) . ' ' . strtoupper($apellidos) . ', também denominado(a) Segurado(a), está coberto pelo Seguro XXXXXXXXXX pelo prazo de 12 (doze) meses, conforme suas Condições Gerais, Especiais e Particulares e de acordo com as regras abaixo:  

1.	Coberturas:
As Coberturas estão definidas de acordo com o Plano contratado pelo Segurado, conforme informado na contratação do Seguro:';

        $pdf->MultiCell(0, 5, iconv('UTF-8', 'windows-1252', $texto), 0, 'J', 0);
        //Table

        $header = iconv('UTF-8', 'windows-1252', 'INFORMAÇÕES GERAIS DO BEM SEGURADO E COBERTURA CONTRATADA');

        $row1 = array("Equipamento Segurado", $descrip);
        $row2 = array("Cobertura Securitária", "Roubo ou Furto Qualificado");
        $row3 = array("Limite Máximo de Indenização", "R$ " . number_format(ltrim($precioprod, '0'),2));
        $row4 = array("Número da Nota Fiscal do Equipamento", $notafiscallong);
        $row5 = array("Data de Compra do Equipamento", date("d/m/Y", strtotime($datecompra)));
        $row6 = array("Prêmio Anual com IOF", "R$ " . number_format(ltrim($preciolong, '0'),2));
        $data = array($row1, $row2, $row3, $row4, $row5, $row6);

        $pdf->ImprovedTable($header, $data);
        $pdf->Ln();

        //Table

        $pdf->SetLeftMargin(30);
        $pdf->SetRightMargin(30);
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetDrawColor(51, 51, 153);

        $texto = '2.	Vigência do Seguro: a vigência do seguro inicia-se às 24 horas da data de adesão.
Início: ' . date("d/m/Y") . '   Fim: ' . date("d/m/Y", strtotime("$fecha+$plazo month")) . '
3.	A descrição completa do Seguro, bem como suas regras e limites estão descritos na íntegra no Manual do Segurado disponível no site www.xxxxxxxxxxx.com.br.

Seguro de Aparelhos Portáteis registrado na Superintendência de Seguros Privados (SUSEP) sob nº 15414.001519/2008-86. Apólice Nº ' . $npoliza . '.
Seguradora: Royal & SunAlliance (Brasil) S.A. – CNPJ: 33.065.699/0001-27.
Estipulante: Afinext LLC. 
Sub-Estipulante: Paymentz do Brasil Gestão de Creditos Virtuais Ltda. – CNPJ: 13.492.000/0001-06. 
Corretora: Via Global Consultoria e Corretagem de Seguros Ltda. – CNPJ: 08.775.527/0001-08. 
Nos termos da legislação civil, o pagamento do prêmio implica na contratação do seguro, e aceitação das condições gerais e condições pactuadas no certificado, onde estão descritos os dados do proponente, do produto, o período de cobertura e número de controle.
Nos termos da Resolução CNSP nº 107/04, a remuneração do Estipulante corresponde ao fator percentual equivalente de 0,35 a 0,40, incidente sobre o prêmio recebido, líquido de IOF.
O registro deste plano na SUSEP não implica, por parte da Autarquia, incentivo ou recomendação à sua comercialização.
O Segurado poderá consultar a situação cadastral do seu corretor de seguros, no site www.susep.gov.br, por meio do número do seu registro na SUSEP, nome completo, CNPJ ou CPF.';

        //$pdf->Write(5, iconv('UTF-8', 'windows-1252', $texto));
        $pdf->MultiCell(0, 5, iconv('UTF-8', 'windows-1252', $texto), 0, 'J', 0);
        $pdf->SetTopMargin(50);
        $pdf->AddPage();
        $pdf->SetTopMargin(20);
        $pdf->Image('images/logoRSA.png', 20, 8, 30);
        $pdf->Image('images/flechaRSA.png', 0, 30, 150);

        $pdf->MultiCell(0, 5, iconv('UTF-8', 'windows-1252', 'MANUAL DO SEGURO DE ROUBO OU FURTO QUALIFICADO DE PORTÁTEIS'), 0, 'C', 0);
        $pdf->Ln();

        $texto = 'Você está recebendo o Resumo das Condições Gerais do Seguro de Roubo ou Furto Qualificado de Portáteis. 
Aqui você vai encontrar informações sobre coberturas, regras, limites e demais condições do seu seguro. 

1.	DEFINIÇÕES
Depreciação: é o percentual, definido na apólice, que será deduzido do valor de Nota Fiscal do equipamento, determinando seu valor atual, levando em conta o critério de idade do aparelho.
Estipulante: é a pessoa física ou jurídica que contrata apólice coletiva de seguros, ficando investido dos poderes de representação dos Segurados perante a Seguradora.
Franquia: é o valor ou percentual definido na apólice pelo qual o Segurado fica responsável em caso de sinistro.
Indenização: é o valor pago pela Seguradora, em conseqüência da ocorrência de um sinistro coberto pelo seguro.
Limite Máximo de Indenização – LMI: é o valor máximo a ser pago pela Seguradora com base na apólice, quando da ocorrência de determinado evento durante a vigência desta apólice e garantido pela cobertura contratada. 
Riscos Excluídos: são os eventos previstos nas Condições Gerais do Seguro que não estarão cobertos.
Segurado: Pessoa Física que seja cliente do Estipulante e solicite expressamente sua inclusão ao seguro.
Sinistro: é a ocorrência de evento coberto, durante o período de vigência do seguro.

2.	RESUMO DO PRODUTO
2.1	Através do Certificado do Seguro, o Segurado encontrará a vigência da presente apólice, o valor do prêmio que será cobrado, o equipamento coberto, a definição das coberturas contratadas, bem como os limites máximos de indenização. 
2.2	A indenização deste seguro será devida, exclusivamente aos equipamentos elegíveis com até 2 (dois) anos de uso, calculados pela diferença entre a data de compra do equipamento definida pela Nota Fiscal e a data da ocorrência do sinistro.
	2.2.1	Serão consideradas válidas as Notas Fiscais dos equipamentos que estiverem em nome do Segurado.
2.3	Âmbito Geográfico da Cobertura: Este seguro é válido mundialmente. No caso de sinistro no exterior, o Segurado deverá registrar o fato no país de origem da ocorrência e realizar a reclamação no Brasil quando do seu retorno, sendo que a reposição ou indenização será feita somente no Brasil, porém respeitando o prazo prescricional previsto no Código Civil Brasileiro.
	2.3.1	Nos casos de sinistros de equipamentos comprados em moeda estrangeira, a indenização será paga em moeda corrente nacional.
2.4	A simples posse deste Resumo de Condições Gerais não valida a 	cobertura.

3.	PERÍODO DE VIGÊNCIA
3.1	A vigência do seguro será de 12 (doze) meses e inicia-se às 24 (vinte e quatro) horas do dia da assinatura de Proposta de Adesão ao Seguro.

4.	RISCOS COBERTOS
O Segurado terá direito à indenização em caso de Roubo ou Furto Qualificado, observadas as exclusões e demais condições deste seguro. 
4.1      Roubo ou Furto Qualificado
4.1.1	Roubo: é a subtração do bem, cometida mediante ameaça ou emprego de violência contra pessoa ou depois de havê-la, por qualquer meio, reduzido à impossibilidade de resistência, quer pela ação física, quer pela aplicação de narcóticos ou assalto à mão armada;
4.1.2	Furto Qualificado: é a subtração do bem, cometida com destruição ou rompimento de obstáculos ou mediante escalada ou utilização de outras vias que não as destinadas a servir de entrada ao local onde se encontram os bens cobertos, ou mediante emprego de chave falsa, gazua ou instrumentos semelhantes, desde que a utilização de qualquer destes meios tenha deixado vestígios materiais inequívocos, ou tenha sido constatada por inquérito policial.

5.	CARÊNCIA, DEPRECIAÇÃO E FRANQUIA
5.1     Carência
Este produto possui carência de 30 (trinta) dias, contados a partir da data do início de vigência do Certificado. Durante este período, o equipamento segurado não será elegível à indenização em caso de evento coberto. 

5.2	Depreciação
	Em caso de sinistro, após comprovação do evento, será aplicado sobre o valor definido na Nota Fiscal do equipamento, o percentual de depreciação por tempo de uso, sendo:
5.2.1	Equipamentos com até 1 (um) ano de uso: não será aplicada a depreciação;
5.2.2	Equipamentos com até 2 (dois) anos de uso: 20% (vinte por cento).
O tempo de uso do equipamento será determinado pela diferença entre a data da ocorrência do sinistro e a data de compra do equipamento registrada na Nota Fiscal ou Outro Comprovante de Compra que seja aceito pela Seguradora, em nome do Segurado.
5.2.3	Em caso de sinistro de Roubo ou Furto Qualificado, caso a Nota Fiscal ou Outro Comprovante de Compra do equipamento não seja apresentada será aplicado 50% (cinqüenta por cento) de depreciação sobre o valor do equipamento. 
O valor do equipamento, caso não seja apresentada a Nota Fiscal de compra em nome do Segurado, será definido pelo valor de mercado, limitado ao Limite Máximo de Indenização por Aparelho Segurado, conforme definido pela Seguradora.
5.2.3.1 O valor de mercado do equipamento será definido pela média de valores após pesquisa em 3 (três) fontes distintas, feita pela Seguradora.

5.3	Franquia
	Após o cálculo de depreciação, o valor referente à indenização sofrerá o desconto de 20% (vinte por cento) a título de franquia, que será aplicado sobre o valor do bem, atualizado de acordo com o percentual definido no item Depreciação deste Manual.

6.	PAGAMENTO DO PRÊMIO
	O valor do prêmio referente à vigência do Seguro será cobrado conforme opção do Segurado. 
Caso o pagamento não seja confirmado pela Seguradora, o Seguro não será emitido e as condições descritas neste Manual não serão válidas.
		Caso ocorra sinistro dentro do prazo de pagamento, sem que tenha sido efetuado, o direito à indenização não será prejudicado.
	
7.	RISCOS EXCLUÍDOS
	Estão excluídos os seguintes riscos:
a)	Reposição de aparelho eletrônico portátil diferente do constante na nota fiscal ou cupom fiscal de compra, salvo se o modelo segurado não estiver disponível para reposição, situação em que deverá haver acordo entre as partes para definição do aparelho a ser reposto;
b)	Extorsão mediante seqüestro e extorsão indireta, conforme definido no Código Penal Brasileiro;
c)	Quebra e/ou perdas parciais de qualquer tipo não decorrentes dos riscos cobertos;
d)	Danos ocasionados pelo derramamento ou queda do aparelho portátil em líquidos de qualquer espécie;
e)	Fenômenos da natureza, inclusive chuva;
f)	Inundação ou alagamento;
g)	Aparelho eletrônico portátil proveniente de contrabando, transporte ou comércio ilegal;
h)	Uso em condições não recomendadas pelo fabricante ou em situações de sobrecarga;
i)	Infidelidade, apropriação indébita, dolo, culpa grave equiparada ao dolo, má-fé, cumplicidade, ato intencional ou negligência do Segurado ou dos beneficiários do seguro;
j)	Perda de faturamento ou perda de mercado, assim como prejuízos financeiros e lucros cessantes por paralisação parcial ou total do aparelho eletrônico portátil;
k)	Cartões e/ou créditos telefônicos remanescentes de aparelhos com sistema pré-pago;
l)	Operações de reparo, ajustamento e serviços de manutenção;
m)	Eventos ocorridos com o aparelho segurado decorrentes de atos ilícitos praticados pelo proprietário ou por aquele que esteja de posse do mesmo;
n)	Guerras e suas conseqüências;
o)	Tumultos e suas conseqüências;
p)	Quaisquer outros riscos não expressamente constantes das coberturas contratadas definidas nas Condições Gerais e descritas nas respectivas Condições Particulares; 
q)	Danos ou perdas causados direta ou indiretamente por guerra ou invasão, atos de inimigos estrangeiros, atos de hostilidade, guerra civil, rebelião ou revolução, insurreição, poder militar usurpante ou usurpado ou atividades maliciosas de pessoas a favor de ou em ligação com qualquer organização política, confisco, comando, requisição ou destruição ou dano ao bem segurado por ordem política ou social ou de qualquer autoridade civil.
r)	Furto simples do bem segurado. Entende-se por Furto simples o furto cometido sem emprego de violência e sem que seja deixado qualquer vestígio;
s)	Estelionato, perda, extravio ou simples desaparecimento do bem segurado;
t)	Furto de aparelho eletrônico portátil deixado em edificações que não sejam totalmente fechadas por paredes;
u)	Furto de aparelho eletrônico portátil deixado no interior de automóveis, salvo se ocorrer o furto total do veículo;
v)	Roubo ou furto de qualquer tipo de acessório, sem que haja o roubo ou furto do bem segurado;
w)	Roubo ou furto praticados por empregados do Segurado, fixos ou temporários, bem como sócios, terceiros ou familiares; 
x)	Danos ocorridos exclusivamente aos componentes do “kit básico” do aparelho eletrônico portátil, mesmo que decorrentes de riscos cobertos.


Os acessórios do “kit básico” roubados ou furtados (Furto Qualificado), isoladamente, não estão cobertos pelas garantias oferecidas pelo Seguro. Considera-se como “kit básico” o conjunto montado e/ou comercializado no Brasil pelo fabricante do aparelho portátil, constituindo-se de todos os acessórios e demais componentes que integram a embalagem de venda de portáteis.
Ratifica-se que quaisquer acessórios não componentes do “kit básico” ou não declarados na Nota Fiscal ou em Outro Comprovante de Compra aceito pela Seguradora que sejam roubados ou furtados, isoladamente ou conjuntamente, não estão cobertos pelas garantias oferecidas pelo Seguro. 

8.	CONDIÇÕES PARA INDENIZAÇÃO
8.1		Em caso de sinistro, o Segurado deverá comunicar o evento, tão logo seja possível, através da Central de Atendimento ao Segurado informada neste documento. 
	O Segurado deverá preencher a Carta de Comunicação do sinistro contendo as seguintes informações: 
a)	nome do titular do seguro, nº do RG, nº do CPF, endereço completo (rua, número, CEP, etc), telefone residencial, celular e comercial, o Segurado deverá enviar a seguinte documentação:
b)	Cópia do RG e do CPF do Segurado;
c)	Cópia do Certificado do Seguro;
d)	Declaração contendo nome, RG e CPF de duas pessoas autorizadas para o recebimento do bem, caso o Segurado designe terceiro para receber a indenização;
e)	Cópia da Nota Fiscal ou Outro Comprovante de Compra referente ao aparelho eletrônico portátil sinistrado, em nome do Segurado: caso o documento não seja apresentado, será aplicado 50% (cinquenta por cento) de depreciação sobre o valor do equipamento, além da franquia, prevista neste Manual;
f)	Boletim de Ocorrência Policial original (ou cópia autenticada), no qual devem ser especificados detalhadamente: o local, descrição do sinistro, data e hora;

8.3	Após apresentação de todos os documentos necessários à comprovação do sinistro, a avaliação dos prejuízos indenizáveis e, em caso de parecer favorável, a Seguradora terá o prazo de 30 (trinta) dias para efetuar a reposição do equipamento sinistrado.
	8.3.1	Caso seja necessário envio de documentação complementar, solicitado pela Seguradora, a contagem deste prazo será suspensa e reiniciada a partir do dia útil subseqüente ao recebimento dos documentos. 

8.4	Em situações excepcionais, de acordo com a liberalidade da Seguradora, a indenização poderá ser paga ao Segurado em espécie (moeda nacional). Para estes casos, do valor a ser indenizado será deduzida a depreciação prevista na tabela constante na Cláusula Particular – Indenização Paga em Espécie que faz parte das Condições Gerais do presente Seguro.

9.	CANCELAMENTO DO SEGURO
9.1	Este seguro poderá ser cancelado:
9.1.1	A qualquer momento por solicitação do Segurado, através da Central de Atendimento, desde que seja feito por escrito, mediante preenchimento do Formulário de Cancelamento e com antecedência mínima de 30 (trinta) dias.
9.1.2	Imediatamente, quando da constatação da perda de direito pelo Segurado.

9.2.	Na hipótese de cancelamento do Seguro, a Seguradora reterá o prêmio calculado de acordo com a tabela de Prazo Curto abaixo:';

        $pdf->MultiCell(0, 5, iconv('UTF-8', 'windows-1252', $texto), 0, 'J', 0);

        //Table

        $header = array("Dias de Vigência","% Prêmio Devido","Dias de Vigência","% Prêmio Devido");

        $row1 = array("15","13","195","73");
        $row2 = array("30","20","210","75");
        $row3 = array("45","27","225","78");
        $row4 = array("60","30","240","80");
        $row5 = array("75","37","255","83");
        $row6 = array("90","40","270","85");
        $row7 = array("105","46","285","88");
        $row8 = array("120","50","300","90");
        $row9 = array("135","56","315","93");
        $row10 = array("150","60","330","95");
        $row11 = array("165","66","345","98");
        $row12 = array("180","70","365","100");
        $data = array($row1, $row2, $row3, $row4, $row5, $row6,$row7, $row8, $row9, $row10, $row11, $row12);

        $pdf->BasicTable($header, $data);
        $pdf->Ln();

        //Table
        
        $texto = '10.	RENOVAÇÃO DO SEGURO
10.1	Este seguro é por prazo determinado tendo a Seguradora a faculdade de não renovar o certificado na data de seu vencimento, sem devolução dos prêmios de seguro pagos nos termos desta apólice.
10.2	A primeira renovação deste seguro poderá ser realizada de forma automática pela Seguradora.

11.	OBSERVAÇÕES GERAIS
A aceitação do Seguro estará sujeita à análise do risco.
O registro deste plano na SUSEP não implica, por parte da Autarquia, incentivo ou recomendação a sua comercialização.
O Segurado poderá consultar a situação cadastral de seu corretor de seguros no site www.susep.gov.br, por meio de número de seu registro na SUSEP, nome completo, CNPJ ou CPF.
Este documento contém o Resumo das Condições Gerais do Seguro. Os riscos cobertos acima descritos, bem como todas as definições e exclusões constam nas Condições Gerais e Particulares das Apólices, que estão disponíveis no site www.xxxxxxxxxxxxxx.com.br.

Processo SUSEP nº 15414.001519/2008-86. Apólice nº. 0000000.
Estipulante: Afinext LLC.
Corretora: Via Global Consultoria e Corretagem de Seguros Ltda.
CNPJ: 08.775.527/0001-08. Registro SUSEP:050.716.1.057.881-9.
Seguradora: Royal & SunAlliance Seguros (Brasil) S/A .
CNPJ: 33.065.699/0001-27. Registro SUSEP: 675-1.';
        
        $pdf->MultiCell(0, 5, iconv('UTF-8', 'windows-1252', $texto), 0, 'J', 0);

        $pdf->Output("..//polizas//" . $npoliza . ".pdf", "F"); //Descargar al server

        $pdfdoc = $pdf->Output("", "S");
        $sql = "update sec_poliza set pdf = '" . mysql_real_escape_string($pdfdoc) . "' where npoliza ='" . $npoliza . "'";
        mysql_query($sql);

//Notificar a RSA
        notifrsa($npoliza, $idusr_long, $namelong, $addrlong, $barriolong, $ciudadlong, $estadolong, $ziplong, $telefonolong, $legallong, $cedulalong, $id_item, $referencialong, $precioprod, $preciolong, $datecompra, $datefactura, $plazolong, $notafiscallong);

//Envio de mail

        $mail = new PHPMailer();
        $mail->SetFrom("info@tuavenida.com");
        $mail->Subject = "tuavenida";

        $mail->AddAddress($email);
        $mail->Subject = "Poliza en Tuavenida.com";
        $mail->Body = "Informacion de compra poliza";
        $mail->AddAttachment("..//polizas//" . $npoliza . ".pdf");

        if (!$mail->Send()) {
            echo "Error sending: " . $mail->ErrorInfo;
            ;
        } else {
            echo "Letter sent";
        }
    }//Cierre while de items
//
}
else
    header('x', true, 204);
?>