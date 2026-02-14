
const CONFIG = {
    APP_NAME: 'NORTHSAFE',
    VERSION: '1.0.0',
    API_ENDPOINT: '/api', // Placeholder for Laravel backend
    AI_ENDPOINT: '/api/ai/classify', // Placeholder for AI classification
    STORAGE_PREFIX: 'northsafe_',
    MAX_IMAGE_SIZE: 100 * 1024 * 1024, // 10MB
    ALLOWED_IMAGE_TYPES: ['image/jpeg', 'image/png', 'image/jpg'],
    HAZARD_CATEGORIES: [
        'Fire Hazard',
        'Flood',
        'Road Damage',
        'Fallen Tree',
        'Power Line',
        'Building Damage',
        'Illegal Dumping',
        'Other'
    ],
    SEVERITY_LEVELS: ['Low', 'Medium', 'High', 'Critical'],
    STATUS_TYPES: ['Pending', 'Verified', 'In Progress', 'Resolved', 'Rejected']
};

// ============ STORAGE KEYS ============
const STORAGE = {
    CURRENT_USER: `${CONFIG.STORAGE_PREFIX}current_user`,
    REPORTS: `${CONFIG.STORAGE_PREFIX}reports`,
    USERS: `${CONFIG.STORAGE_PREFIX}users`,
    SETTINGS: `${CONFIG.STORAGE_PREFIX}settings`
};

// ============ DEMO DATA ============
const DEMO_ACCOUNTS = {
    users: [
        {
            id: 1,
            email: 'user@northsafe.com',
            password: 'user123',
            name: 'Juan Dela Cruz',
            role: 'user',
            barangay: 'Barangay 171',
            phone: '+63 912 345 6789',
            points: 150,
            reportsCount: 12,
            createdAt: '2025-12-01'
        },
        {
            id: 2,
            email: 'maria@northsafe.com',
            password: 'user123',
            name: 'Maria Santos',
            role: 'user',
            barangay: 'Barangay 172',
            phone: '+63 923 456 7890',
            points: 200,
            reportsCount: 18,
            createdAt: '2025-11-15'
        }
    ],
    admins: [
        {
            id: 101,
            email: 'admin@northsafe.com',
            password: 'admin123',
            name: 'Admin User',
            role: 'admin',
            department: 'City Hall',
            createdAt: '2025-10-01'
        },
        {
            id: 102,
            email: 'responder@northsafe.com',
            password: 'admin123',
            name: 'Response Team',
            role: 'admin',
            department: 'Emergency Response',
            createdAt: '2025-10-01'
        }
    ]
};

// ============ STATE MANAGEMENT ============
const AppState = {
    currentUser: null,
    reports: [],
    isLoading: false,

    init() {
        this.loadUser();
        this.loadReports();
    },

    loadUser() {
        const userStr = localStorage.getItem(STORAGE.CURRENT_USER);
        this.currentUser = userStr ? JSON.parse(userStr) : null;
    },

    loadReports() {
        const reportsStr = localStorage.getItem(STORAGE.REPORTS);
        this.reports = reportsStr ? JSON.parse(reportsStr) : this.generateDemoReports();
    },

    saveUser(user) {
        this.currentUser = user;
        localStorage.setItem(STORAGE.CURRENT_USER, JSON.stringify(user));
    },

    saveReports(reports) {
        this.reports = reports;
        localStorage.setItem(STORAGE.REPORTS, JSON.stringify(reports));
    },

    clearUser() {
        this.currentUser = null;
        localStorage.removeItem(STORAGE.CURRENT_USER);
    },

    generateDemoReports() {
        return [
            {
                id: 1,
                userId: 1,
                userName: 'Juan Dela Cruz',
                userBarangay: 'Barangay 171',
                category: 'Road Damage',
                severity: 'High',
                status: 'Pending',
                title: 'Large Pothole on Main Road',
                description: 'Deep pothole causing traffic issues and potential accidents',
                location: {
                    address: 'Main Street, Barangay 171',
                    latitude: 14.7560,
                    longitude: 120.9876,
                    barangay: 'Barangay 171'
                },
                imageUrl: null,
                aiClassification: {
                    predicted: 'Road Damage',
                    confidence: 0.95,
                    timestamp: '2026-02-05T10:30:00'
                },
                votes: { up: 12, down: 1 },
                comments: [],
                createdAt: '2026-02-05T10:30:00',
                updatedAt: '2026-02-05T10:30:00',
                timeline: [
                    { status: 'Pending', timestamp: '2026-02-05T10:30:00', note: 'Report submitted' }
                ]
            },
            {
                id: 2,
                userId: 2,
                userName: 'Maria Santos',
                userBarangay: 'Barangay 172',
                category: 'Flood',
                severity: 'Medium',
                status: 'In Progress',
                title: 'Clogged Drainage System',
                description: 'Water accumulation due to blocked drainage, affecting nearby homes',
                location: {
                    address: 'Corner Street, Barangay 172',
                    latitude: 14.7580,
                    longitude: 120.9890,
                    barangay: 'Barangay 172'
                },
                imageUrl: null,
                aiClassification: {
                    predicted: 'Flood',
                    confidence: 0.88,
                    timestamp: '2026-02-04T14:20:00'
                },
                votes: { up: 8, down: 0 },
                comments: [
                    {
                        id: 1,
                        userId: 1,
                        userName: 'Juan Dela Cruz',
                        text: 'This has been an issue for weeks now',
                        timestamp: '2026-02-04T16:00:00'
                    }
                ],
                createdAt: '2026-02-04T14:20:00',
                updatedAt: '2026-02-05T09:00:00',
                timeline: [
                    { status: 'Pending', timestamp: '2026-02-04T14:20:00', note: 'Report submitted' },
                    { status: 'Verified', timestamp: '2026-02-04T16:00:00', note: 'Verified by admin' },
                    { status: 'In Progress', timestamp: '2026-02-05T09:00:00', note: 'Cleanup crew dispatched' }
                ]
            },
            {
                id: 3,
                userId: 1,
                userName: 'Juan Dela Cruz',
                userBarangay: 'Barangay 171',
                category: 'Fire Hazard',
                severity: 'Critical',
                status: 'Resolved',
                title: 'Exposed Electrical Wiring',
                description: 'Dangerous exposed wires near residential area, immediate attention needed',
                location: {
                    address: 'Block 5, Barangay 171',
                    latitude: 14.7555,
                    longitude: 120.9865,
                    barangay: 'Barangay 171'
                },
                imageUrl: null,
                aiClassification: {
                    predicted: 'Fire Hazard',
                    confidence: 0.92,
                    timestamp: '2026-02-01T08:15:00'
                },
                votes: { up: 25, down: 0 },
                comments: [],
                createdAt: '2026-02-01T08:15:00',
                updatedAt: '2026-02-02T15:30:00',
                resolvedAt: '2026-02-02T15:30:00',
                timeline: [
                    { status: 'Pending', timestamp: '2026-02-01T08:15:00', note: 'Report submitted' },
                    { status: 'Verified', timestamp: '2026-02-01T08:30:00', note: 'Verified as critical' },
                    { status: 'In Progress', timestamp: '2026-02-01T09:00:00', note: 'Electrical team notified' },
                    { status: 'Resolved', timestamp: '2026-02-02T15:30:00', note: 'Wiring repaired and secured' }
                ]
            }
        ];
    }
};

// ============ AUTHENTICATION ============
const Auth = {
    login(email, password) {
        const users = this.getAllAccounts();
        const user = users.find(u => u.email === email && u.password === password);

        if (user) {
            const { password, ...userWithoutPassword } = user;
            AppState.saveUser(userWithoutPassword);
            return { success: true, user: userWithoutPassword };
        }

        return { success: false, message: 'Invalid email or password' };
    },

    register(userData) {
        const users = JSON.parse(localStorage.getItem(STORAGE.USERS)) || DEMO_ACCOUNTS;
        const allAccounts = [...users.users, ...users.admins];

        if (allAccounts.some(u => u.email === userData.email)) {
            return { success: false, message: 'Email already registered' };
        }

        const newUser = {
            id: Date.now(),
            ...userData,
            role: 'user',
            points: 0,
            reportsCount: 0,
            createdAt: new Date().toISOString()
        };

        users.users.push(newUser);
        localStorage.setItem(STORAGE.USERS, JSON.stringify(users));

        const { password, ...userWithoutPassword } = newUser;
        AppState.saveUser(userWithoutPassword);

        return { success: true, user: userWithoutPassword };
    },

    logout() {
        AppState.clearUser();
        // Redirect to login page
        const isInPagesDir = window.location.pathname.includes('/pages/');
        window.location.href = isInPagesDir ? 'login.php' : 'pages/login.php';
    },

    async getCurrentUser() {
        try {
            const response = await fetch('../backend/session_check.php', {
                method: 'GET',
                credentials: 'include'
            });

            const data = await response.json();

            if (data.authenticated) {
                return data.user;
            }

            return null;

        } catch (error) {
            console.error('Failed to fetch session user:', error);
            return null;
        }
    },

    isAuthenticated() {
        return AppState.currentUser !== null;
    },


    async requireAuth(redirectUrl = 'login.php') {

    try {
        const response = await fetch('../backend/session_check.php', {
            method: 'GET',
            credentials: 'include'
        });

        const data = await response.json();

        if (!data.authenticated) {

            const isInPagesDir = window.location.pathname.includes('/pages/');
            const finalRedirect = isInPagesDir
                ? redirectUrl
                : `pages/${redirectUrl}`;

            window.location.href = finalRedirect;
            return false;
        }

        return true;

    } catch (error) {
        console.error('Session check failed:', error);
        window.location.href = redirectUrl;
        return false;
    }
    },

    getAllAccounts() {
        const stored = localStorage.getItem(STORAGE.USERS);
        const accounts = stored ? JSON.parse(stored) : DEMO_ACCOUNTS;
        return [...accounts.users, ...accounts.admins];
    }
};

// ============ REPORTS MANAGEMENT ============
const Reports = {
    getAll() {
        return AppState.reports;
    },

    getById(reportId) {
        return AppState.reports.find(r => r.id === reportId);
    },

    getByUser(userId) {
        return AppState.reports.filter(r => r.userId === userId);
    },

    getByStatus(status) {
        return AppState.reports.filter(r => r.status === status);
    },

    getByBarangay(barangay) {
        return AppState.reports.filter(r => r.location.barangay === barangay);
    },

    async create(reportData) {

    const formData = new FormData();

    formData.append("category", reportData.category);
    formData.append("severity", reportData.severity);
    formData.append("title", reportData.title);
    formData.append("description", reportData.description);
    formData.append("address", reportData.location.address);
    formData.append("barangay", reportData.location.barangay);
    formData.append("latitude", reportData.location.latitude);
    formData.append("longitude", reportData.location.longitude);

    if (reportData.imageFile) {
        formData.append("image", reportData.imageFile);
    }

    const response = await fetch("../backend/create-report.php", {
        method: "POST",
        body: formData,
        credentials: "include"
    });

    return await response.json();
},

    async classifyImage(imageFile) {
        // Placeholder for AI image classification
        // In production, this would call your Laravel backend AI endpoint

        return new Promise((resolve) => {
            setTimeout(() => {
                const categories = CONFIG.HAZARD_CATEGORIES;
                const randomCategory = categories[Math.floor(Math.random() * categories.length)];
                const confidence = 0.75 + Math.random() * 0.2; // 75-95%

                resolve({
                    predicted: randomCategory,
                    confidence: parseFloat(confidence.toFixed(2)),
                    timestamp: new Date().toISOString(),
                    note: 'AI classification placeholder - will be replaced with actual ML model'
                });
            }, 1000);
        });
    },

    updateStatus(reportId, newStatus, note = '') {
        const reports = AppState.reports.map(report => {
            if (report.id === reportId) {
                const timeline = [...report.timeline, {
                    status: newStatus,
                    timestamp: new Date().toISOString(),
                    note: note || `Status changed to ${newStatus}`
                }];

                return {
                    ...report,
                    status: newStatus,
                    updatedAt: new Date().toISOString(),
                    timeline: timeline,
                    ...(newStatus === 'Resolved' && { resolvedAt: new Date().toISOString() })
                };
            }
            return report;
        });

        AppState.saveReports(reports);
        return { success: true };
    },

    addComment(reportId, commentText) {
        const user = Auth.getCurrentUser();
        if (!user) return { success: false, message: 'User not authenticated' };

        const reports = AppState.reports.map(report => {
            if (report.id === reportId) {
                const newComment = {
                    id: Date.now(),
                    userId: user.id,
                    userName: user.name,
                    text: commentText,
                    timestamp: new Date().toISOString()
                };

                return {
                    ...report,
                    comments: [...report.comments, newComment],
                    updatedAt: new Date().toISOString()
                };
            }
            return report;
        });

        AppState.saveReports(reports);
        return { success: true };
    },

    vote(reportId, voteType) {
        const user = Auth.getCurrentUser();
        if (!user) return { success: false, message: 'User not authenticated' };

        const reports = AppState.reports.map(report => {
            if (report.id === reportId) {
                const votes = { ...report.votes };
                if (voteType === 'up') {
                    votes.up += 1;
                } else if (voteType === 'down') {
                    votes.down += 1;
                }

                return { ...report, votes };
            }
            return report;
        });

        AppState.saveReports(reports);
        return { success: true };
    },

    delete(reportId) {
        const reports = AppState.reports.filter(r => r.id !== reportId);
        AppState.saveReports(reports);
        return { success: true };
    }
};

// ============ STATISTICS ============
const Stats = {
    getReportStats() {
        const reports = Reports.getAll();
        return {
            total: reports.length,
            pending: reports.filter(r => r.status === 'Pending').length,
            verified: reports.filter(r => r.status === 'Verified').length,
            inProgress: reports.filter(r => r.status === 'In Progress').length,
            resolved: reports.filter(r => r.status === 'Resolved').length,
            rejected: reports.filter(r => r.status === 'Rejected').length
        };
    },

    getCategoryStats() {
        const reports = Reports.getAll();
        const stats = {};

        reports.forEach(report => {
            stats[report.category] = (stats[report.category] || 0) + 1;
        });

        return stats;
    },

    getSeverityStats() {
        const reports = Reports.getAll();
        const stats = {};

        reports.forEach(report => {
            stats[report.severity] = (stats[report.severity] || 0) + 1;
        });

        return stats;
    },

    getBarangayStats() {
        const reports = Reports.getAll();
        const stats = {};

        reports.forEach(report => {
            const barangay = report.location.barangay;
            stats[barangay] = (stats[barangay] || 0) + 1;
        });

        return stats;
    }
};

// ============ VALIDATION ============
const Validate = {
    email(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    },

    password(password) {
        return password.length >= 6;
    },

    required(value) {
        return value && value.trim() !== '';
    },

    phone(phone) {
        return /^[\d\s\+\-\(\)]+$/.test(phone);
    },

    imageFile(file) {
        if (!file) return { valid: true };

        if (!CONFIG.ALLOWED_IMAGE_TYPES.includes(file.type)) {
            return { valid: false, message: 'Only JPG and PNG images are allowed' };
        }

        if (file.size > CONFIG.MAX_IMAGE_SIZE) {
            return { valid: false, message: 'Image size must be less than 10MB' };
        }

        return { valid: true };
    }
};

// ============ UI HELPERS ============
const UI = {
    showError(inputElement, message) {
        inputElement.classList.add('error');
        const errorDiv = inputElement.parentElement.querySelector('.input-error-message');
        if (errorDiv) {
            errorDiv.textContent = message;
            errorDiv.classList.add('active');
        }
    },

    clearError(inputElement) {
        inputElement.classList.remove('error');
        const errorDiv = inputElement.parentElement.querySelector('.input-error-message');
        if (errorDiv) {
            errorDiv.classList.remove('active');
        }
    },

    showAlert(message, type = 'success') {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} animate-slide-up`;
        alertDiv.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
            <span>${message}</span>
        `;

        document.body.insertBefore(alertDiv, document.body.firstChild);

        setTimeout(() => {
            alertDiv.style.opacity = '0';
            setTimeout(() => alertDiv.remove(), 300);
        }, 4000);
    },

    showLoading(element) {
        element.disabled = true;
        element.innerHTML = '<div class="spinner"></div> Loading...';
    },

    hideLoading(element, originalText) {
        element.disabled = false;
        element.innerHTML = originalText;
    },

    formatDate(dateString) {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('en-US', options);
    },

    formatDateTime(dateString) {
        const options = {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        };
        return new Date(dateString).toLocaleDateString('en-US', options);
    },

    getRelativeTime(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const seconds = Math.floor((now - date) / 1000);

        if (seconds < 60) return 'Just now';
        if (seconds < 3600) return `${Math.floor(seconds / 60)} minutes ago`;
        if (seconds < 86400) return `${Math.floor(seconds / 3600)} hours ago`;
        if (seconds < 604800) return `${Math.floor(seconds / 86400)} days ago`;
        return this.formatDate(dateString);
    }
};

// ============ IMAGE HANDLING ============
const ImageHandler = {
    async processImage(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();

            reader.onload = (e) => {
                resolve(e.target.result);
            };

            reader.onerror = () => {
                reject(new Error('Failed to read image file'));
            };

            reader.readAsDataURL(file);
        });
    },

    previewImage(file, imgElement) {
        const reader = new FileReader();

        reader.onload = (e) => {
            imgElement.src = e.target.result;
            imgElement.parentElement.classList.remove('hidden');
        };

        reader.readAsDataURL(file);
    }
};

// ============ INITIALIZATION ============
// Initialize immediately to prevent race conditions with page auth checks
AppState.init();

// Initialize demo data if not exists
if (!localStorage.getItem(STORAGE.USERS)) {
    localStorage.setItem(STORAGE.USERS, JSON.stringify(DEMO_ACCOUNTS));
}

if (!localStorage.getItem(STORAGE.REPORTS)) {
    localStorage.setItem(STORAGE.REPORTS, JSON.stringify(AppState.generateDemoReports()));
}

// ============ EXPORT ============
if (typeof window !== 'undefined') {
    window.NORTHSAFE = {
        CONFIG,
        Auth,
        Reports,
        Stats,
        Validate,
        UI,
        ImageHandler,
        AppState
    };
}