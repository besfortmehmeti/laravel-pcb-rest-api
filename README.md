# PCB Payment Gateway API

----

**Description:**

Library for working with **PCB Payment Gateway (PCB, also known as ProCredit Bank)** Service <br/>
provided by Quipu Processing Center

---

**Installation:**

```
composer require besfortmehmeti/laravel-pcb-rest-api
```

---

**Usage examples:**

```
use Fortshpejt\PCB\Facades\Pcb;

Pcb::createOrderRequest($order_id, $amount, $description, $currency);
```

---