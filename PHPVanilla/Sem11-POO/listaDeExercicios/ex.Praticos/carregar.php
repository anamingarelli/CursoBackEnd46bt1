<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/Exceptions/ContaException.php';
require_once __DIR__ . '/../src/Exceptions/SaldoInsuficienteException.php';
require_once __DIR__ . '/../src/Exceptions/ValorInvalidoException.php';

require_once __DIR__ . '/../src/Dominio/Titular.php';
require_once __DIR__ . '/../src/Interfaces/NotificadorInterface.php';
require_once __DIR__ . '/../src/Dominio/Transacao.php';

require_once __DIR__ . '/../src/Dominio/ContaBancaria.php';
require_once __DIR__ . '/../src/Dominio/ContaCorrente.php';
require_once __DIR__ . '/../src/Dominio/ContaPoupanca.php';

require_once __DIR__ . '/../src/Notificacoes/NotificadorEmail.php';
require_once __DIR__ . '/../src/Notificacoes/NotificadorSMS.php';
require_once __DIR__ . '/../src/Notificacoes/NotificadorWhatsApp.php';