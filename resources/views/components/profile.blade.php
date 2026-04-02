    <div class="container my-5">
        <div class="row">
            <!-- Боковая панель с информацией пользователя -->
            <div class="col-md-4 mb-4">
                <!-- Карточка профиля -->
                <div class="card">
                    <div class="card-body text-center">
                        <!-- Фотография пользователя -->
                        <div class="mb-3">
                            <div class="bg-secondary rounded-circle d-inline-flex align-items-center justify-content-center" 
                                 style="width: 120px; height: 120px;">
                                <i class="bi bi-person-fill text-white" style="font-size: 3rem;"></i>
                            </div>
                        </div>
                        
                        <!-- Имя и фамилия -->
                        <h4 class="card-title">Иван Иванов</h4>
                        
                        <!-- Контактная информация -->
                        <div class="text-start mt-4">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-telephone text-primary me-3"></i>
                                <div>
                                    <small class="text-muted d-block">Телефон</small>
                                    <span>+7 (999) 123-45-67</span>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-envelope text-primary me-3"></i>
                                <div>
                                    <small class="text-muted d-block">Email</small>
                                    <span>ivan.ivanov@example.com</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Кнопка редактирования -->
                        <button class="btn btn-outline-primary mt-3 w-100">
                            <i class="bi bi-pencil me-2"></i>Редактировать профиль
                        </button>
                    </div>
                </div>

                <!-- Кнопка удаления аккаунта -->
                <div class="card mt-4 border-danger">
                    <div class="card-body">
                        <h6 class="card-title text-danger">
                            <i class="bi bi-exclamation-triangle me-2"></i>Удаление аккаунта
                        </h6>
                        <p class="card-text small text-muted mb-3">
                            Это действие нельзя отменить. Все данные будут удалены.
                        </p>
                        <button class="btn btn-outline-danger w-100" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                            <i class="bi bi-trash me-2"></i>Удалить аккаунт
                        </button>
                    </div>
                </div>
            </div>

            <!-- Основной контент - список бронирований -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-calendar-check me-2"></i>Мои бронирования
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- Активные бронирования -->
                        <h6 class="text-success mb-3">
                            <i class="bi bi-check-circle me-2"></i>Активные бронирования
                        </h6>
                        
                        <!-- Бронирование 1 -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h6 class="card-title">Лесной домик "У озера"</h6>
                                        <p class="card-text mb-1 text-muted">
                                            <i class="bi bi-calendar me-2"></i>15-20 мая 2024
                                        </p>
                                        <p class="card-text mb-1 text-muted">
                                            <i class="bi bi-people me-2"></i>2 взрослых
                                        </p>
                                        <p class="card-text mb-0 text-muted">
                                            <i class="bi bi-geo-alt me-2"></i>Карелия, озеро Янисъярви
                                        </p>
                                    </div>
                                    <div class="col-md-4 text-md-end">
                                        <span class="badge bg-success mb-2">Подтверждено</span>
                                        <p class="h5 text-success mb-0">12 500 ₽</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Бронирование 2 -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h6 class="card-title">Панорамный шатер "Горный вид"</h6>
                                        <p class="card-text mb-1 text-muted">
                                            <i class="bi bi-calendar me-2"></i>10-12 июня 2024
                                        </p>
                                        <p class="card-text mb-1 text-muted">
                                            <i class="bi bi-people me-2"></i>4 взрослых
                                        </p>
                                        <p class="card-text mb-0 text-muted">
                                            <i class="bi bi-geo-alt me-2"></i>Алтай, Чемальский район
                                        </p>
                                    </div>
                                    <div class="col-md-4 text-md-end">
                                        <span class="badge bg-warning text-dark mb-2">Ожидает оплаты</span>
                                        <p class="h5 mb-0">18 000 ₽</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Прошлые бронирования -->
                        <h6 class="text-secondary mt-4 mb-3">
                            <i class="bi bi-clock-history me-2"></i>Прошлые бронирования
                        </h6>

                        <!-- Бронирование 3 -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h6 class="card-title text-muted">Домик "Лесная сказка"</h6>
                                        <p class="card-text mb-1 text-muted">
                                            <i class="bi bi-calendar me-2"></i>20-25 августа 2023
                                        </p>
                                        <p class="card-text mb-0 text-muted">
                                            <i class="bi bi-geo-alt me-2"></i>Ленинградская область
                                        </p>
                                    </div>
                                    <div class="col-md-4 text-md-end">
                                        <span class="badge bg-secondary mb-2">Завершено</span>
                                        <p class="h6 text-muted mb-0">8 500 ₽</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Бронирование 4 -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h6 class="card-title text-muted">Шатер "Звездная ночь"</h6>
                                        <p class="card-text mb-1 text-muted">
                                            <i class="bi bi-calendar me-2"></i>15-17 июля 2023
                                        </p>
                                        <p class="card-text mb-0 text-muted">
                                            <i class="bi bi-geo-alt me-2"></i>Краснодарский край
                                        </p>
                                    </div>
                                    <div class="col-md-4 text-md-end">
                                        <span class="badge bg-secondary mb-2">Завершено</span>
                                        <p class="h6 text-muted mb-0">6 200 ₽</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Модальное окно подтверждения удаления аккаунта -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="deleteAccountModalLabel">
                        <i class="bi bi-exclamation-triangle me-2"></i>Подтверждение удаления
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Вы уверены, что хотите удалить свой аккаунт?</p>
                    <p class="text-muted small">Все ваши данные будут безвозвратно удалены.</p>
                    
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" id="confirmDelete">
                        <label class="form-check-label text-danger" for="confirmDelete">
                            Я понимаю последствия и хочу удалить аккаунт
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-danger" id="deleteAccountBtn">
                        <i class="bi bi-trash me-2"></i>Удалить аккаунт
                    </button>
                </div>
            </div>
        </div>
    </div>