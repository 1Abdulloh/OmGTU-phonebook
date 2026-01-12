# Muammolar va Yechimlar

## ✅ Hal qilingan muammolar:

### 1. Login/Parol muammosi
**Muammo:** Login va parol ishlamayapti

**Yechim:**
- Password hash to'g'ri yaratilgan, lekin agar ishlamasa:
  1. `fix_password.php` faylini brauzerda oching: `http://localhost/oxirgi/fix_password.php`
  2. Bu fayl password hash ni yangilaydi
  3. Keyin faylni o'chiring (xavfsizlik uchun)

**Login ma'lumotlari:**
- Username: `EgorVikulov`
- Password: `EgorOmGTU`

### 2. "Вернуться на сайт" linki
**Muammo:** Link ishlamayapti

**Yechim:** Link to'g'rilandi - endi `../index.php` ga ishora qiladi

### 3. CRUD operatsiyalari
**Muammo:** Create tugmasi ko'rinmayapti

**Yechim:** 
- CRUD operatsiyalari allaqachon mavjud va ishlayapti
- Admin panelda:
  - **Контакты** → "Добавить контакт" tugmasi mavjud
  - **Подразделения** → "Добавить подразделение" tugmasi mavjud
  - **Пользователи** (faqat admin) → "Добавить пользователя" tugmasi mavjud

### 4. Yangi admin qo'shish
**Muammo:** Yangi adminlarni qayerdan qo'shish kerak?

**Yechim:**
1. Admin bo'lib kirish: `http://localhost/oxirgi/admin/login.php`
2. Chap menuda **Пользователи** bo'limiga o'ting
3. "Добавить пользователя" tugmasini bosing
4. Formani to'ldiring:
   - Логин: yangi username
   - Пароль: yangi parol (kamida 6 belgi)
   - Email: email manzil
   - Имя/Фамилия: ism va familiya
   - Роль: **admin** ni tanlang
5. "Создать пользователя" tugmasini bosing

**Endi yangi kontaktlar qo'shish:**
- Admin panel → Контакты → "Добавить контакт"
- Formani to'ldiring va saqlang
- phpMyAdmin ga murojaat qilish shart emas!

### 5. Yandex avtorizatsiya
**Muammo:** Yandex orqali kirish ishlamayapti

**Yechim:**
- Yandex OAuth hozircha sozlanmagan
- Oddiy login/password orqali kirish ishlayapti
- Yandex OAuth ni sozlash uchun:
  1. Yandex Developer Console da ilova yaratish kerak
  2. Client ID va Secret olish kerak
  3. `.env` fayl yaratish va sozlamalarni qo'yish kerak
  4. `composer install` qilish kerak (oauth2-client paketlari uchun)

## 📝 Qo'shimcha ma'lumotlar:

### Admin panel yo'llari:
- Bosh sahifa: `http://localhost/oxirgi/admin/`
- Kontaktlar: `http://localhost/oxirgi/admin/contacts/`
- Bo'limlar: `http://localhost/oxirgi/admin/departments/`
- Foydalanuvchilar: `http://localhost/oxirgi/admin/users/` (faqat admin)

### CRUD operatsiyalari:
- **Create:** Har bir bo'limda "Добавить" tugmasi
- **Read:** Ro'yxat sahifalarida ko'rsatiladi
- **Update:** Har bir yozuvda "Редактировать" tugmasi
- **Delete:** Admin uchun "Удалить" tugmasi

### Rollar:
- **admin:** Barcha huquqlar (CRUD, foydalanuvchilarni boshqarish)
- **editor:** Kontaktlar va bo'limlarni boshqarish (CRUD)
- **viewer:** Faqat ko'rish (Read)

## ⚠️ Muhim eslatmalar:

1. `fix_password.php` faylini ishlatgandan keyin o'chiring!
2. Yangi admin qo'shganda, unga email manzilni to'g'ri kiriting (Yandex login uchun)
3. Parollar kamida 6 belgi bo'lishi kerak
4. Admin panel faqat `admin` va `editor` rollari uchun ochiq
