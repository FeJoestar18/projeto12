<style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #fafafa; /* Alterado para um fundo menos intenso */
            color: #333;
            line-height: 1.6;
        }

        header {
            background-color: #fff;
            padding: 15px;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo img {
            width: 180px;
            height: auto;
        }

        /* Menu Icon */
        .menu-icon {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 30px;
            height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .menu-icon:hover .bar {
            background-color: #4CAF50;
        }

        .bar {
            height: 3px;
            width: 100%;
            background-color: #333;
            border-radius: 5px;
            transition: 0.3s;
        }

        /* Carrinho de compras */
        .cart-icon {
            width: 24px;
            height: 24px;
            cursor: pointer;
        }

        .cart-count {
            position: absolute;
            top: 0;
            right: 0;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 3px 6px;
            font-size: 0.8rem;
        }

        .cart {
            position: relative;
            margin-right: 20px;
        }

        /* Title Section */
        .titulo {
            margin-top: 120px;
            text-align: center;
            padding: 20px;
        }

        .titulo h1 {
            color: #333;
            font-size: 3rem;
            font-weight: 600;
        }

        .titulo h3 {
            margin-top: 10px;
            color: #666;
            font-size: 1.5rem;
            font-weight: 300;
        }

        /* Botão Ir às Compras */
        .shop-btn {
            display: inline-block;
            margin-top: 30px;
            padding: 15px 30px;
            background-color: #4CAF50;
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .shop-btn:hover {
            background-color: #388e3c;
        }

        /* Cards Section */
        .cards-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            padding: 60px 20px;
            flex-wrap: nowrap; /* Mantém todos os cards na mesma linha */
        }

        .card, .side-card {
            background-color: #fff;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            width: 280px;
            height: 280px;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .card:hover, .side-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            background-color: #4CAF50;
            color: white;
        }

        .card h2, .side-card h2 {
            color: #4CAF50;
            margin-bottom: 10px;
            font-size: 1.8rem;
        }

        .card p, .side-card p {
            color: #666;
            font-size: 1.1rem;
            line-height: 1.5;
        }

        /* Footer */
        .sidebar {
            position: fixed;
            top: 0;
            right: -300px;
            width: 300px;
            height: 100%;
            background-color: #fff;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.05);
            transition: 0.5s;
            z-index: 1001;
        }

        .sidebar.open {
            right: 0;
        }

        .sidebar ul {
            list-style: none;
            padding: 20px;
            margin: 0;
        }

        .sidebar ul li {
            padding: 15px 0;
            border-bottom: 1px solid #e1e1e1;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .sidebar ul li a:hover {
            color: #4CAF50;
        }

        .sidebar ul li a.logout {
            color: #ff0000;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 1000;
        }

        .overlay.show {
            display: block;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            right: -300px;
            width: 300px;
            height: 100%;
            background-color: #fff;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.05);
            transition: 0.5s;
            z-index: 1001;
        }

        .sidebar.open {
            right: 0;
        }

        .sidebar ul {
            list-style: none;
            padding: 20px;
            margin: 0;
        }

        .sidebar ul li {
            padding: 15px 0;
            border-bottom: 1px solid #e1e1e1;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .sidebar ul li a:hover {
            color: #4CAF50;
        }

        .sidebar ul li a.logout {
            color: #ff0000;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 1000;
        }

        .overlay.show {
            display: block;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .cards-container {
                flex-direction: column;
                align-items: center;
            }

            .titulo h1 {
                font-size: 2.5rem;
            }

            .titulo h3 {
                font-size: 1.2rem;
            }

            .card, .side-card {
                width: 100%;
                height: auto;
            }
        }

        .profile-icon {
            width: 30px; /* Ajuste o tamanho do ícone conforme necessário */
            height: auto;
            margin-right: 10px;
        }