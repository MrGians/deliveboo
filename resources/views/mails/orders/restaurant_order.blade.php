<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Deliveboo</title>
</head>
<body>
  <div id="order-success-page">
          <div class="order-success-card shadow text-center my-5">
              <h2>Staff Deliveboo</h2>
              <h4 class="text-success">Hai ricevuto un nuovo ordine!</h4>
              <p>
                  N. Ordine: <strong>{{ $new_order['id'] }}</strong> | Totale: <strong>€{{ $new_order['amount'] }}</strong>
              </p>
              <hr/>
              <h4>Dettagli Ordine:</h4>
              <ul class="custom-list">
                <li>Cliente: <strong>{{ $new_order['full_name'] }}</strong></li>
                <li>Email: <strong>{{ $new_order['email'] }}</strong></li>
                <li>Indirizzo: <strong>{{ $new_order['address'] }}</strong></li>
                <li>Telefono: <strong>{{ $new_order['tel'] }}</strong></li>
              </ul>
              <a href="http://localhost:8000/"  class="home-btn">
                  Torna alla Homepage
              </a>
          </div>
      </div>
  
  <style>
    .shadow {
      box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
  }
  .text-center {
    text-align: center;
  }
  .text-success{
    color:#2fb871;
  }

  .custom-list {
    text-align: initial;  
    margin: 0 auto;
    list-style-position: inside;
  }
  #order-success-page {
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0 auto;
    background-color: #ffbd42
  }
  .order-success-card {
        width: 50%;
        background-color: white;
        padding: 1.5rem;
        border-radius: 1.5rem;
        margin: 3rem 0
  }
  
  h2 {
      color: #fc5959;
      margin-top: 1rem;
  }
  
  p {
      margin: 1rem;
  }
        
 
  
  .home-btn {
      display: inline-block;
      padding: 0.6rem 1.2rem;
      border: 2px solid #2fb871;
      background-color: #2fb871;
      color: white;
      font-weight: 700;
      border-radius: 30px;
      margin-top: 1rem;
      transition: all 0.35s;
      text-decoration: none;
      cursor: pointer;
  
    }
    .home-btn:hover {
        background-color: #ffbd42;
        border: 2px solid #ffbd42;
    }
  
  </style>
  

</body>  
</html>
