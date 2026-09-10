<?php
// Teklif Oluşturma Scripti
// Bu dosya hem formu hem de PDF/Yazdırma önizlemesini içerir.
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Teklif Sihirbazı</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --primary-light: #eff6ff;
            --danger: #ef4444;
            --surface: #ffffff;
            --bg-app: #f1f5f9;
            --bg-preview: #e2e8f0;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --text-light: #94a3b8;
            --border: #e2e8f0;
            --radius-md: 8px;
            --radius-lg: 12px;
            --radius-xl: 16px;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --shadow-page: 0 25px 50px -12px rgb(0 0 0 / 0.25);
            --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            font-size: 14px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-app);
            color: var(--text-main);
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }

        /* Layout */
        .app-layout {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 450px;
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            z-index: 10;
            box-shadow: var(--shadow-lg);
        }

        .sidebar-header {
            padding: 24px;
            border-bottom: 1px solid var(--border);
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(8px);
            position: sticky;
            top: 0;
            z-index: 20;
        }

        .sidebar-title {
            font-size: 1.25rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-main);
        }

        .sidebar-title i {
            color: var(--primary);
        }

        .btn-print {
            width: 100%;
            margin-top: 20px;
            background: var(--primary);
            color: white;
            border: none;
            padding: 14px;
            border-radius: var(--radius-lg);
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: var(--transition);
            box-shadow: 0 4px 14px 0 rgba(37, 99, 235, 0.39);
        }

        .btn-print:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px 0 rgba(37, 99, 235, 0.39);
        }

        .sidebar-content {
            padding: 24px;
            overflow-y: auto;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* Form Elements */
        .form-section {
            background: var(--bg-app);
            padding: 20px;
            border-radius: var(--radius-xl);
            border: 1px solid var(--border);
        }

        .form-section-title {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-section-title i {
            width: 18px;
            height: 18px;
            color: var(--text-muted);
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .form-row {
            display: flex;
            gap: 12px;
        }

        .form-row .form-group {
            flex: 1;
        }

        label.input-label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 10px 12px;
            border-radius: var(--radius-md);
            border: 1px solid #cbd5e1;
            font-family: 'Inter', sans-serif;
            font-size: 0.875rem;
            transition: var(--transition);
            background: var(--surface);
            color: var(--text-main);
            outline: none;
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        /* File Upload Custom */
        .file-upload-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-upload-wrapper input[type="file"] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
        }

        .file-upload-btn {
            background-color: var(--primary-light);
            color: var(--primary);
            border: 1px dashed var(--primary);
            padding: 12px;
            border-radius: var(--radius-md);
            text-align: center;
            font-weight: 500;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: var(--transition);
        }

        .file-upload-wrapper:hover .file-upload-btn {
            background-color: #dbeafe;
        }
        
        .logo-preview-container {
            margin-top: 12px;
            display: none;
            align-items: center;
            justify-content: space-between;
            background: var(--surface);
            padding: 10px;
            border-radius: var(--radius-md);
            border: 1px solid var(--border);
        }
        
        .logo-preview-img {
            max-height: 40px;
            max-width: 150px;
            object-fit: contain;
        }

        .btn-remove-logo {
            color: var(--danger);
            background: none;
            border: none;
            font-size: 0.75rem;
            font-weight: 600;
            cursor: pointer;
        }

        /* Items Section */
        .item-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 16px;
            margin-bottom: 12px;
            position: relative;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
        }

        .item-card:hover {
            border-color: #cbd5e1;
            box-shadow: var(--shadow);
        }

        .item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .item-number {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-light);
            text-transform: uppercase;
        }

        .btn-remove {
            color: var(--text-light);
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: var(--transition);
            display: flex;
        }

        .btn-remove:hover {
            color: var(--danger);
            background: #fee2e2;
        }

        .btn-add-item {
            width: 100%;
            background: transparent;
            color: var(--primary);
            border: 2px dashed #bfdbfe;
            padding: 12px;
            border-radius: var(--radius-lg);
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: var(--transition);
        }

        .btn-add-item:hover {
            background: var(--primary-light);
            border-color: var(--primary);
        }

        /* Checkbox custom */
        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--surface);
            padding: 12px 16px;
            border-radius: var(--radius-md);
            border: 1px solid var(--border);
            cursor: pointer;
            transition: var(--transition);
        }

        .checkbox-wrapper:hover {
            border-color: #93c5fd;
        }

        .checkbox-wrapper input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .checkbox-wrapper span {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-main);
        }

        /* Preview Area */
        .preview-area {
            flex: 1;
            background: var(--bg-preview);
            overflow-y: auto;
            display: flex;
            justify-content: center;
            padding: 40px;
        }

        .a4-page {
            width: 210mm;
            min-height: 297mm;
            background: var(--surface);
            box-shadow: var(--shadow-page);
            position: relative;
            display: flex;
            flex-direction: column;
            color: var(--text-main);
        }

        /* A4 Content Styling */
        .a4-top-bar {
            height: 8px;
            width: 100%;
            background: var(--primary);
        }

        .a4-content {
            padding: 50px 60px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .a4-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 60px;
        }

        .a4-logo-area {
            width: 50%;
        }

        .a4-logo-img {
            max-height: 80px;
            max-width: 250px;
            object-fit: contain;
            margin-bottom: 20px;
        }

        .a4-company-name {
            font-size: 1.75rem;
            font-weight: 900;
            letter-spacing: -0.5px;
            color: var(--text-main);
            margin-bottom: 16px;
            text-transform: uppercase;
        }

        .a4-sender-info {
            font-size: 0.875rem;
            color: var(--text-muted);
            white-space: pre-wrap;
            line-height: 1.6;
        }

        .a4-meta-area {
            width: 50%;
            text-align: right;
        }

        .a4-document-title {
            font-size: 2.5rem;
            font-weight: 300;
            color: #cbd5e1;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 24px;
        }

        .a4-meta-grid {
            display: inline-grid;
            grid-template-columns: auto auto;
            column-gap: 20px;
            row-gap: 8px;
            text-align: right;
            font-size: 0.875rem;
        }

        .a4-meta-label {
            font-weight: 600;
            color: var(--text-muted);
        }

        .a4-meta-val {
            color: var(--text-main);
        }

        .a4-recipient-section {
            display: flex;
            margin-bottom: 50px;
        }

        .a4-recipient-box {
            width: 50%;
            border-left: 4px solid var(--primary);
            padding-left: 20px;
        }

        .a4-recipient-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .a4-recipient-name {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-main);
            line-height: 1.2;
            margin-bottom: 4px;
        }

        .a4-recipient-attn {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .a4-recipient-address {
            font-size: 0.875rem;
            color: var(--text-muted);
            white-space: pre-wrap;
            line-height: 1.6;
        }

        /* A4 Table */
        .a4-table-container {
            margin-bottom: 40px;
            flex: 1;
        }

        .a4-table {
            width: 100%;
            border-collapse: collapse;
        }

        .a4-table th {
            padding: 12px 16px;
            font-size: 0.875rem;
            font-weight: 700;
            color: var(--text-main);
            border-bottom: 2px solid var(--text-main);
            text-align: left;
        }

        .a4-table th.text-center { text-align: center; }
        .a4-table th.text-right { text-align: right; }

        .a4-table td {
            padding: 16px;
            border-bottom: 1px solid var(--border);
            vertical-align: top;
        }

        .a4-item-title {
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 4px;
        }

        .a4-item-desc {
            font-size: 0.75rem;
            color: var(--text-muted);
            white-space: pre-wrap;
        }

        .a4-item-qty {
            text-align: center;
            font-size: 0.875rem;
            color: var(--text-main);
        }

        .a4-item-price, .a4-item-total {
            text-align: right;
            font-size: 0.875rem;
            color: var(--text-main);
            white-space: nowrap;
        }

        .a4-item-total {
            font-weight: 600;
        }

        /* A4 Totals */
        .a4-totals-section {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 50px;
        }

        .a4-totals-box {
            width: 350px;
        }

        .a4-total-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        .a4-total-row.border-b {
            border-bottom: 1px solid var(--border);
        }

        .a4-total-row.grand-total {
            padding: 16px 0;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary);
            border-bottom: none;
        }

        /* A4 Notes & Footer */
        .a4-notes {
            background: var(--bg-app);
            padding: 20px;
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            margin-top: auto;
        }

        .a4-notes-title {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-main);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .a4-notes-content {
            font-size: 0.8rem;
            color: var(--text-muted);
            white-space: pre-wrap;
            line-height: 1.6;
        }

        .a4-footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            text-align: center;
            font-size: 0.75rem;
            color: var(--text-light);
        }

        /* Print Media Query */
        @media print {
            body * {
                visibility: hidden;
            }
            .sidebar {
                display: none !important;
            }
            .preview-area {
                padding: 0 !important;
                background: none !important;
                display: block !important;
            }
            #printable-area, #printable-area * {
                visibility: visible;
                text-rendering: geometricPrecision !important;
                -webkit-font-smoothing: antialiased !important;
                -moz-osx-font-smoothing: grayscale !important;
                color-adjust: exact !important;
                -webkit-print-color-adjust: exact !important;
            }
            #printable-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 0;
                box-shadow: none;
            }
            @page {
                size: A4;
                margin: 0;
            }
        }
        
        /* Custom Scrollbar for Sidebar */
        .sidebar-content::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar-content::-webkit-scrollbar-track {
            background: transparent;
        }
        .sidebar-content::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="app-layout">
    
    <!-- LEFT PANEL: CONTROLS & FORM -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h1 class="sidebar-title">
                <i data-lucide="calculator"></i>
                Teklif Sihirbazı
            </h1>
            <button onclick="window.print()" class="btn-print">
                <i data-lucide="printer"></i>
                PDF Olarak İndir / Yazdır
            </button>
        </div>

        <div class="sidebar-content">
            
            <!-- Firma Logosu -->
            <div class="form-section">
                <h2 class="form-section-title"><i data-lucide="upload"></i> Firma Logosu</h2>
                <div class="file-upload-wrapper">
                    <button class="file-upload-btn">
                        <i data-lucide="image"></i> Logo Seç...
                    </button>
                    <input type="file" id="inpLogo" accept="image/*">
                </div>
                <div class="logo-preview-container" id="logoPreviewContainer">
                    <img src="" alt="Logo Önizleme" class="logo-preview-img" id="imgLogoPreview">
                    <button class="btn-remove-logo" id="btnRemoveLogo">Logoyu Kaldır</button>
                </div>
            </div>

            <!-- Gönderen Bilgileri -->
            <div class="form-section">
                <h2 class="form-section-title"><i data-lucide="building-2"></i> Gönderen (Siz)</h2>
                <div class="form-group">
                    <input type="text" id="inpSenderName" placeholder="Firma Adı" value="Şirketiniz A.Ş.">
                </div>
                <div class="form-group">
                    <textarea id="inpSenderAddress" placeholder="Adres">Teknoloji Plaza Kat: 4 No: 12&#10;Kadıköy, İstanbul</textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <input type="text" id="inpSenderPhone" placeholder="Telefon" value="+90 555 123 45 67">
                    </div>
                    <div class="form-group">
                        <input type="email" id="inpSenderEmail" placeholder="E-posta" value="hello@sirketiniz.com">
                    </div>
                </div>
                <div class="form-group mt-3" style="margin-top: 12px;">
                    <input type="text" id="inpSenderWebsite" placeholder="Web Sitesi" value="www.sirketiniz.com">
                </div>
            </div>

            <!-- Alıcı Bilgileri -->
            <div class="form-section">
                <h2 class="form-section-title"><i data-lucide="user"></i> Alıcı (Müşteri)</h2>
                <div class="form-group">
                    <input type="text" id="inpRecipientName" placeholder="Firma / Kişi Adı" value="Müşteri Firması Tic. Ltd. Şti.">
                </div>
                <div class="form-group">
                    <input type="text" id="inpRecipientAttn" placeholder="İlgili Kişi (İsteğe bağlı)" value="Ahmet Yılmaz">
                </div>
                <div class="form-group">
                    <textarea id="inpRecipientAddress" placeholder="Adres">Organize Sanayi Bölgesi 1. Cad.&#10;No: 55 Şişli, İstanbul</textarea>
                </div>
            </div>

            <!-- Belge Ayarları -->
            <div class="form-section">
                <h2 class="form-section-title"><i data-lucide="file-text"></i> Belge Ayarları</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label class="input-label">Teklif No</label>
                        <input type="text" id="inpQuoteNumber">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="input-label">Tarih</label>
                        <input type="date" id="inpQuoteDate">
                    </div>
                    <div class="form-group">
                        <label class="input-label">Geçerlilik</label>
                        <input type="date" id="inpQuoteValid">
                    </div>
                </div>
            </div>

            <!-- Hizmet ve Ürünler -->
            <div class="form-section">
                <h2 class="form-section-title"><i data-lucide="list"></i> Hizmet ve Ürünler</h2>
                <div id="itemsContainer">
                    <!-- Items will be generated here by JS -->
                </div>
                <button class="btn-add-item" id="btnAddItem" style="margin-top: 16px;">
                    <i data-lucide="plus"></i> Yeni Kalem Ekle
                </button>
            </div>

            <!-- Finans ve Notlar -->
            <div class="form-section" style="margin-bottom: 40px;">
                <h2 class="form-section-title"><i data-lucide="settings"></i> Finans & Notlar</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label class="input-label">KDV Oranı (%)</label>
                        <input type="number" id="inpTaxRate" min="0" value="20">
                    </div>
                    <div class="form-group">
                        <label class="input-label">Para Birimi</label>
                        <select id="inpCurrency">
                            <option value="₺">₺ (TL)</option>
                            <option value="$">$ (USD)</option>
                            <option value="€">€ (EUR)</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="checkbox-wrapper">
                        <input type="checkbox" id="inpTaxIncluded">
                        <span>Girdiğim Fiyatlara KDV Dahil</span>
                    </label>
                </div>
                <div class="form-group" style="margin-top: 16px;">
                    <label class="input-label">Müşteriye Özel Notlar / Şartlar</label>
                    <textarea id="inpNotes">Bu teklif belgesi, üzerinde belirtilen tarihe kadar geçerlidir. Ödemelerin %50'si iş başlangıcında, kalanı teslimatta nakit veya banka havalesi ile alınır.</textarea>
                </div>
            </div>

        </div>
    </div>

    <!-- RIGHT PANEL: A4 PREVIEW -->
    <div class="preview-area">
        <div id="printable-area" class="a4-page">
            <div class="a4-top-bar"></div>
            
            <div class="a4-content">
                <!-- Header -->
                <div class="a4-header">
                    <div class="a4-logo-area">
                        <img id="outLogo" src="" alt="Logo" class="a4-logo-img" style="display: none;">
                        <div id="outCompanyName" class="a4-company-name">ŞİRKETİNİZ A.Ş.</div>
                        <div class="a4-sender-info" id="outSenderInfo"></div>
                    </div>
                    <div class="a4-meta-area">
                        <div class="a4-document-title">TEKLİF</div>
                        <div class="a4-meta-grid">
                            <div class="a4-meta-label">Teklif No:</div>
                            <div class="a4-meta-val" id="outQuoteNumber">-</div>
                            
                            <div class="a4-meta-label">Tarih:</div>
                            <div class="a4-meta-val" id="outQuoteDate">-</div>
                            
                            <div class="a4-meta-label">Geçerlilik:</div>
                            <div class="a4-meta-val" id="outQuoteValid">-</div>
                        </div>
                    </div>
                </div>

                <!-- Recipient -->
                <div class="a4-recipient-section">
                    <div class="a4-recipient-box">
                        <div class="a4-recipient-label">Teklif Sunulan</div>
                        <div class="a4-recipient-name" id="outRecipientName"></div>
                        <div class="a4-recipient-attn" id="outRecipientAttn"></div>
                        <div class="a4-recipient-address" id="outRecipientAddress"></div>
                    </div>
                </div>

                <!-- Table -->
                <div class="a4-table-container">
                    <table class="a4-table">
                        <thead>
                            <tr>
                                <th style="width: 50%;">Hizmet / Açıklama</th>
                                <th class="text-center" style="width: 15%;">Miktar</th>
                                <th class="text-right" style="width: 15%;">Birim Fiyat</th>
                                <th class="text-right" style="width: 20%;">Toplam</th>
                            </tr>
                        </thead>
                        <tbody id="outItemsTbody">
                            <!-- Items will be injected here -->
                        </tbody>
                    </table>
                </div>

                <!-- Totals -->
                <div class="a4-totals-section">
                    <div class="a4-totals-box">
                        <div class="a4-total-row">
                            <span>Ara Toplam:</span>
                            <span id="outSubTotal">0.00 ₺</span>
                        </div>
                        <div class="a4-total-row border-b">
                            <span id="outTaxLabel">KDV (%20):</span>
                            <span id="outTaxAmount">0.00 ₺</span>
                        </div>
                        <div class="a4-total-row grand-total">
                            <span>Genel Toplam:</span>
                            <span id="outGrandTotal">0.00 ₺</span>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div class="a4-notes" id="outNotesContainer">
                    <div class="a4-notes-title">Notlar & Şartlar</div>
                    <div class="a4-notes-content" id="outNotes"></div>
                </div>

                <!-- Footer -->
                <div class="a4-footer">
                    Bu bir bilgisayar çıktısıdır. İmza gerektirmeden onaylandığında geçerlilik kazanır.
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    // Initialize Icons
    lucide.createIcons();

    // State
    const state = {
        logo: null,
        items: [
            { id: Date.now(), title: 'Web Tasarım ve Geliştirme', description: 'Kurumsal kimliğe uygun, mobil uyumlu web sitesi tasarımı.', quantity: 1, price: 25000 }
        ]
    };

    // DOM Elements - Inputs
    const inputs = {
        logo: document.getElementById('inpLogo'),
        senderName: document.getElementById('inpSenderName'),
        senderAddress: document.getElementById('inpSenderAddress'),
        senderPhone: document.getElementById('inpSenderPhone'),
        senderEmail: document.getElementById('inpSenderEmail'),
        senderWebsite: document.getElementById('inpSenderWebsite'),
        recipientName: document.getElementById('inpRecipientName'),
        recipientAttn: document.getElementById('inpRecipientAttn'),
        recipientAddress: document.getElementById('inpRecipientAddress'),
        quoteNumber: document.getElementById('inpQuoteNumber'),
        quoteDate: document.getElementById('inpQuoteDate'),
        quoteValid: document.getElementById('inpQuoteValid'),
        taxRate: document.getElementById('inpTaxRate'),
        currency: document.getElementById('inpCurrency'),
        taxIncluded: document.getElementById('inpTaxIncluded'),
        notes: document.getElementById('inpNotes')
    };

    // DOM Elements - Outputs
    const outputs = {
        logo: document.getElementById('outLogo'),
        companyName: document.getElementById('outCompanyName'),
        senderInfo: document.getElementById('outSenderInfo'),
        quoteNumber: document.getElementById('outQuoteNumber'),
        quoteDate: document.getElementById('outQuoteDate'),
        quoteValid: document.getElementById('outQuoteValid'),
        recipientName: document.getElementById('outRecipientName'),
        recipientAttn: document.getElementById('outRecipientAttn'),
        recipientAddress: document.getElementById('outRecipientAddress'),
        itemsTbody: document.getElementById('outItemsTbody'),
        subTotal: document.getElementById('outSubTotal'),
        taxLabel: document.getElementById('outTaxLabel'),
        taxAmount: document.getElementById('outTaxAmount'),
        grandTotal: document.getElementById('outGrandTotal'),
        notesContainer: document.getElementById('outNotesContainer'),
        notes: document.getElementById('outNotes')
    };

    // SessionStorage persistence
    function saveState() {
        const data = {
            state: state,
            inputs: {}
        };
        for (const key in inputs) {
            if (key === 'logo') continue;
            if (inputs[key]) {
                if (inputs[key].type === 'checkbox') {
                    data.inputs[key] = inputs[key].checked;
                } else {
                    data.inputs[key] = inputs[key].value;
                }
            }
        }
        sessionStorage.setItem('teklifFormData', JSON.stringify(data));
    }

    function loadState() {
        const saved = sessionStorage.getItem('teklifFormData');
        if (saved) {
            try {
                const data = JSON.parse(saved);
                if (data.state) {
                    state.logo = data.state.logo || null;
                    if (data.state.items && data.state.items.length > 0) {
                        state.items = data.state.items;
                    }
                }
                if (data.inputs) {
                    for (const key in data.inputs) {
                        if (inputs[key]) {
                            if (inputs[key].type === 'checkbox') {
                                inputs[key].checked = data.inputs[key];
                            } else {
                                inputs[key].value = data.inputs[key];
                            }
                        }
                    }
                }
                if (state.logo) {
                    document.getElementById('imgLogoPreview').src = state.logo;
                    document.getElementById('logoPreviewContainer').style.display = 'flex';
                }
            } catch (e) {
                console.error("State loading error", e);
            }
        }
    }

    // Initialize Dates and Number
    const today = new Date();
    const validDate = new Date(today.getTime() + 15 * 24 * 60 * 60 * 1000);
    
    inputs.quoteNumber.value = 'TEK-' + Math.floor(Math.random() * 10000);
    inputs.quoteDate.value = today.toISOString().split('T')[0];
    inputs.quoteValid.value = validDate.toISOString().split('T')[0];

    loadState(); // Load saved data before rendering

    // Format Currency
    function formatCurrency(amount) {
        return new Intl.NumberFormat('tr-TR', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(amount) + ' ' + inputs.currency.value;
    }

    function formatDate(dateStr) {
        if (!dateStr) return '-';
        const date = new Date(dateStr);
        return date.toLocaleDateString('tr-TR');
    }

    // Logo Handling
    inputs.logo.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onloadend = () => {
                state.logo = reader.result;
                document.getElementById('imgLogoPreview').src = state.logo;
                document.getElementById('logoPreviewContainer').style.display = 'flex';
                updatePreview();
            };
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('btnRemoveLogo').addEventListener('click', () => {
        state.logo = null;
        inputs.logo.value = '';
        document.getElementById('imgLogoPreview').src = '';
        document.getElementById('logoPreviewContainer').style.display = 'none';
        updatePreview();
    });

    // Event Listeners for plain inputs
    Object.values(inputs).forEach(input => {
        if (input && input.id !== 'inpLogo') {
            input.addEventListener('input', updatePreview);
            if (input.type === 'checkbox' || input.tagName === 'SELECT') {
                input.addEventListener('change', updatePreview);
            }
        }
    });

    // Items Handling
    function renderItemsForm() {
        const container = document.getElementById('itemsContainer');
        container.innerHTML = '';
        
        state.items.forEach((item, index) => {
            const itemHTML = `
                <div class="item-card">
                    <div class="item-header">
                        <span class="item-number">Kalem #${index + 1}</span>
                        <button class="btn-remove" onclick="removeItem(${item.id})" ${state.items.length === 1 ? 'disabled style="opacity:0.5;cursor:not-allowed;"' : ''}>
                            <i data-lucide="trash-2" style="width:16px;height:16px;"></i>
                        </button>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Hizmet/Ürün Başlığı" value="${item.title.replace(/"/g, '&quot;')}" oninput="updateItem(${item.id}, 'title', this.value)">
                    </div>
                    <div class="form-group">
                        <textarea placeholder="Kısa Açıklama (İsteğe bağlı)" style="min-height:50px" oninput="updateItem(${item.id}, 'description', this.value)">${item.description}</textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group" style="flex: 0.5;">
                            <label class="input-label">Adet</label>
                            <input type="number" min="1" value="${item.quantity}" oninput="updateItem(${item.id}, 'quantity', this.value)">
                        </div>
                        <div class="form-group">
                            <label class="input-label">Birim Tutar</label>
                            <input type="number" min="0" value="${item.price}" oninput="updateItem(${item.id}, 'price', this.value)">
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', itemHTML);
        });
        lucide.createIcons();
    }

    document.getElementById('btnAddItem').addEventListener('click', () => {
        state.items.push({ id: Date.now(), title: '', description: '', quantity: 1, price: 0 });
        renderItemsForm();
        updatePreview();
    });

    window.removeItem = (id) => {
        if (state.items.length > 1) {
            state.items = state.items.filter(i => i.id !== id);
            renderItemsForm();
            updatePreview();
        }
    };

    window.updateItem = (id, field, value) => {
        const item = state.items.find(i => i.id === id);
        if (item) {
            item[field] = value;
            updatePreview();
        }
    };

    // Update A4 Preview
    function updatePreview() {
        saveState();

        // Logo
        if (state.logo) {
            outputs.logo.src = state.logo;
            outputs.logo.style.display = 'block';
            outputs.companyName.style.display = 'none';
        } else {
            outputs.logo.style.display = 'none';
            outputs.companyName.textContent = inputs.senderName.value || 'FİRMA ADI';
            outputs.companyName.style.display = 'block';
        }

        // Sender Info
        let senderText = inputs.senderAddress.value;
        if (inputs.senderPhone.value) senderText += '\n' + inputs.senderPhone.value;
        if (inputs.senderEmail.value) senderText += '\n' + inputs.senderEmail.value;
        if (inputs.senderWebsite.value) senderText += '\n' + inputs.senderWebsite.value;
        outputs.senderInfo.textContent = senderText;

        // Meta
        outputs.quoteNumber.textContent = inputs.quoteNumber.value || '-';
        outputs.quoteDate.textContent = formatDate(inputs.quoteDate.value);
        outputs.quoteValid.textContent = formatDate(inputs.quoteValid.value);

        // Recipient
        outputs.recipientName.textContent = inputs.recipientName.value || 'Sayın Müşteri';
        outputs.recipientAttn.style.display = inputs.recipientAttn.value ? 'block' : 'none';
        outputs.recipientAttn.textContent = inputs.recipientAttn.value ? 'İlgili: ' + inputs.recipientAttn.value : '';
        outputs.recipientAddress.textContent = inputs.recipientAddress.value;

        // Notes
        if (inputs.notes.value.trim()) {
            outputs.notesContainer.style.display = 'block';
            outputs.notes.textContent = inputs.notes.value;
        } else {
            outputs.notesContainer.style.display = 'none';
        }

        // Table and Math
        outputs.itemsTbody.innerHTML = '';
        let subTotal = 0;

        state.items.forEach(item => {
            const qty = Number(item.quantity) || 0;
            const price = Number(item.price) || 0;
            const total = qty * price;
            subTotal += total;

            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>
                    <div class="a4-item-title">${item.title || '-'}</div>
                    ${item.description ? `<div class="a4-item-desc">${item.description}</div>` : ''}
                </td>
                <td class="a4-item-qty">${qty}</td>
                <td class="a4-item-price">${formatCurrency(price)}</td>
                <td class="a4-item-total">${formatCurrency(total)}</td>
            `;
            outputs.itemsTbody.appendChild(tr);
        });

        // Totals
        const taxRate = Number(inputs.taxRate.value) || 0;
        const taxIncluded = inputs.taxIncluded.checked;
        
        let taxAmount = 0;
        let grandTotal = 0;
        let netTotal = 0;

        if (taxIncluded) {
            taxAmount = subTotal - (subTotal / (1 + taxRate / 100));
            grandTotal = subTotal;
            netTotal = subTotal - taxAmount;
            outputs.taxLabel.textContent = `KDV (%${taxRate}) (Dahil):`;
        } else {
            taxAmount = subTotal * (taxRate / 100);
            grandTotal = subTotal + taxAmount;
            netTotal = subTotal;
            outputs.taxLabel.textContent = `KDV (%${taxRate}):`;
        }

        outputs.subTotal.textContent = formatCurrency(netTotal);
        outputs.taxAmount.textContent = formatCurrency(taxAmount);
        outputs.grandTotal.textContent = formatCurrency(grandTotal);
    }

    // Initial render
    renderItemsForm();
    updatePreview();

</script>
</body>
</html>
