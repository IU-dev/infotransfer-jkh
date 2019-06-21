<header>
    <?php $user = unserialize($_SESSION['user']); ?>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href=""><?php echo $pname; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php echo($page == "index.php" ? "active" : ""); ?>">
                    <a class="nav-link" href="index">Главная</a>
                </li>
                <?php if ($user) : ?>
                    <li class="nav-item <?php echo($page == "counters.php" ? "active" : ""); ?>">
                        <a class="nav-link" href="counters">Счетчики</a>
                    </li>
                    <li class="nav-item dropdown <?php echo($page == "z_counter.php" || $page == "z_master.php" ? "active" : ""); ?>">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Заявки
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item <?php echo($page == "z_counter.php" ? "active" : ""); ?>"
                               href="z_counter">Установка счетчика</a>
                            <a class="dropdown-item <?php echo($page == "z_master.php" ? "active" : ""); ?>"
                               href="z_master">Вызов мастера</a>
                        </div>
                    </li>
                    <?php if ($user->admin > 0) : ?>
                        <li class="nav-item dropdown <?php echo($page == "make_counters.php" || $page == "make_calls.php" || $page == "make_mycalls.php" || $page == "make_call.php" ? "active" : ""); ?>">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                А1 Панель мастера
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <h6 class="dropdown-header">А1.1 Основные функции</h6>
                                <a class="dropdown-item <?php echo($page == "make_counters.php" ? "active" : ""); ?>"
                                   href="make_counters">А1.1.1 Установка счетчика</a>
                                <div class="dropdown-divider"></div>
                                <h6 class="dropdown-header">А1.2 Вызовы</h6>
                                <a class="dropdown-item <?php echo($page == "make_calls.php" ? "active" : ""); ?>"
                                   href="make_calls">А1.2.1 Все вызовы</a>
                                <a class="dropdown-item <?php echo($page == "make_mycalls.php" ? "active" : ""); ?>"
                                   href="make_mycalls">А1.2.2 Мои вызовы</a>
                            </div>
                        </li>
                        <?php if ($user->admin > 1) : ?>
                            <li class="nav-item dropdown <?php echo($page == "a_create_o.php" || $page == "a_list_o.php" || $page == "a_create_d.php" || $page == "a_list_d.php" || $page == "register.php" || $page == "a_list_reb.php" || $page == "a_pos_o.php" || $page == "a_pos_d.php" || $page == "a_rating.php" ? "active" : ""); ?>">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    А2 Панель администратора
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <!---
			<h6 class="dropdown-header">А2.1 Просмотр данных</h6>
			  <a class="dropdown-item <?php echo($page == "a2_counter.php" ? "active" : ""); ?>" href="a2_counter">А2.1.1 Счетчик</a>
			  <a class="dropdown-item <?php echo($page == "a2_client.php" ? "active" : ""); ?>" href="a2_client">А2.1.2 Клиент</a>
			  <div class="dropdown-divider"></div>
			  <h6 class="dropdown-header">А2.2 Интеграции</h6>
			  <a class="dropdown-item <?php echo($page == "a2_es.php" ? "active" : ""); ?>" href="a2_es">А2.2.1 Отправка в Энергосбыт</a>
			  <div class="dropdown-divider"></div>
			  <h6 class="dropdown-header">А2.3 Регистры</h6>
			  <a class="dropdown-item <?php echo($page == "a2_rk.php" ? "active" : ""); ?>" href="a2_rk">А2.3.1 Регистр клиентов</a>
			  <a class="dropdown-item <?php echo($page == "a2_rs.php" ? "active" : ""); ?>" href="a2_rs">А2.3.2 Регистр счетчиков</a>
			  <a class="dropdown-item <?php echo($page == "a2_rw.php" ? "active" : ""); ?>" href="a2_rw">А2.3.3 Регистр сотрудников</a>
			   <div class="dropdown-divider"></div>
			   --->
                                    <h6 class="dropdown-header">А2.1 Работа с пользователями</h6>
                                    <a class="dropdown-item <?php echo($page == "a2_nach.php" ? "active" : ""); ?>"
                                       href="a2_nach">А2.1.1 Зачисление средств</a>
                                    <a class="dropdown-item <?php echo($page == "a2_spis.php" ? "active" : ""); ?>"
                                       href="a2_spis">А2.1.2 Списание средств</a>
                                    <a class="dropdown-item <?php echo($page == "a2_notf.php" ? "active" : ""); ?>"
                                       href="a2_notf">А2.1.3 Уведомление</a>
                                </div>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
            <?php if (isset($_SESSION['logged_in'])) : ?>
                <a class="btn btn-outline-info my-2 my-sm-0" type="button" href="settings.php">Аккаунт</a>
                <a class="btn btn-outline-danger my-2 my-sm-0" type="button" href="logout.php">Выход</a>
            <?php else : ?>
                <a class="btn btn-outline-success my-2 my-sm-0" type="button" href="login.php">Вход</a>
                <a class="btn btn-outline-info my-2 my-sm-0" type="button" href="register.php">Регистрация</a>
            <?php endif; ?>
            </form>
        </div>
    </nav>
</header>