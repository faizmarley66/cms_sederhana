<!-- Content Wrapper. Contains page content -->
<style>
    body, .content-wrapper {
        background: linear-gradient(120deg, #000000 60%, #8B0000 100%) !important;
        min-height: 100vh;
    }
    .dashboard-welcome {
        display: flex;
        align-items: center;
        background: rgba(0,0,0,0.85);
        border-radius: 16px;
        padding: 24px 32px;
        margin-bottom: 32px;
        box-shadow: 0 4px 24px 0 rgba(139,0,0,0.18);
    }
    .dashboard-avatar {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        margin-right: 24px;
        border: 3px solid #8B0000;
        background: #fff;
        object-fit: cover;
    }
    .dashboard-welcome-text {
        color: #fff;
    }
    .dashboard-welcome-text h2 {
        margin: 0 0 6px 0;
        font-size: 2rem;
        font-weight: bold;
        color: #ff0000;
    }
    .dashboard-welcome-text p {
        margin: 0;
        color: #fff;
        font-size: 1.1rem;
    }
    .small-box {
        border-radius: 16px !important;
        box-shadow: 0 2px 16px 0 rgba(139,0,0,0.13);
        transition: transform 0.2s, box-shadow 0.2s;
        position: relative;
        overflow: hidden;
    }
    .small-box:hover {
        transform: translateY(-4px) scale(1.03);
        box-shadow: 0 6px 32px 0 rgba(255,0,0,0.18);
        z-index: 2;
    }
    .small-box .icon {
        top: 10px;
        right: 15px;
        opacity: 0.25;
        font-size: 60px;
    }
    .small-box.bg-info {
        background: linear-gradient(135deg, #232526 60%, #8B0000 100%) !important;
        color: #fff !important;
    }
    .small-box.bg-success {
        background: linear-gradient(135deg, #232526 60%, #ff0000 100%) !important;
        color: #fff !important;
    }
    .small-box.bg-warning {
        background: linear-gradient(135deg, #232526 60%, #ff8800 100%) !important;
        color: #fff !important;
    }
    .small-box-footer {
        color: #fff !important;
        background: rgba(139,0,0,0.13);
        border-radius: 0 0 16px 16px;
        font-weight: bold;
        transition: background 0.2s;
    }
    .small-box-footer:hover {
        background: #8B0000 !important;
        color: #fff !important;
        text-decoration: underline;
    }
    .card {
        border-radius: 16px !important;
        box-shadow: 0 2px 16px 0 rgba(139,0,0,0.13);
        background: rgba(0,0,0,0.92) !important;
        color: #fff;
    }
    .card-title {
        color: #ff0000;
        font-weight: bold;
        font-size: 1.3rem;
    }
    .table {
        color: #fff;
        background: transparent;
    }
    .table thead th {
        background: #8B0000;
        color: #fff;
        border: none;
    }
    .table-hover tbody tr:hover {
        background: rgba(255,0,0,0.08);
        color: #ff0000;
    }
    .table td, .table th {
        border-color: #8B0000;
    }
</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="dashboard-welcome">
                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['username'] ?? 'User'); ?>&background=8B0000&color=fff&size=128" class="dashboard-avatar" alt="User Avatar">
                <div class="dashboard-welcome-text">
                    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>!</h2>
                    <p>Glad to see you back. Here is a quick overview of your CMS activity.</p>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <?php
                            $stmt = $pdo->query("SELECT COUNT(*) FROM posts");
                            $postCount = $stmt->fetchColumn();
                            ?>
                            <h3><?php echo $postCount; ?></h3>
                            <p>Total Posts</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <a href="index.php?page=posts" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <?php
                            $stmt = $pdo->query("SELECT COUNT(*) FROM categories");
                            $categoryCount = $stmt->fetchColumn();
                            ?>
                            <h3><?php echo $categoryCount; ?></h3>
                            <p>Categories</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-folder"></i>
                        </div>
                        <a href="index.php?page=categories" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <?php
                            $stmt = $pdo->query("SELECT COUNT(*) FROM users");
                            $userCount = $stmt->fetchColumn();
                            ?>
                            <h3><?php echo $userCount; ?></h3>
                            <p>Users</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="index.php?page=users" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Posts</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stmt = $pdo->query("SELECT p.*, c.name as category_name 
                                                        FROM posts p 
                                                        LEFT JOIN categories c ON p.category_id = c.id 
                                                        ORDER BY p.created_at DESC LIMIT 5");
                                    while ($row = $stmt->fetch()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['category_name']) . "</td>";
                                        echo "<td>" . date('Y-m-d H:i', strtotime($row['created_at'])) . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div> 