<?php
include '../config.php'; // Database connection

$limit = isset($_GET['perpage']) ? (int)$_GET['perpage'] : 3; // Default to 3 PGs per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Base query
$whereClauses = ["available = 'yes'"];

// Search Filter
if (!empty($_GET['search'])) {
    $search = $_GET['search'];
    $whereClauses[] = "(pg_name LIKE '%$search%' OR location LIKE '%$search%')";
}

// Location Filter
if (!empty($_GET['location'])) {
    $location = $_GET['location'];
    $whereClauses[] = "location = '$location'";
}

// Price Filter
if (!empty($_GET['price'])) {
    if ($_GET['price'] == 'low') {
        $whereClauses[] = "price < 5000";
    } elseif ($_GET['price'] == 'medium') {
        $whereClauses[] = "price BETWEEN 5000 AND 10000";
    } elseif ($_GET['price'] == 'high') {
        $whereClauses[] = "price > 10000";
    }
}

// Facility Filter (Example: WiFi, AC, Parking)
if (!empty($_GET['facilities'])) {
    $selectedFacilities = $_GET['facilities'];
    foreach ($selectedFacilities as $facility) {
        $whereClauses[] = "facilities LIKE '%$facility%'";
    }
}

// Sorting
$orderBy = "price ASC"; // Default sorting
if (!empty($_GET['sort'])) {
    if ($_GET['sort'] == 'low_to_high') {
        $orderBy = "price ASC";
    } elseif ($_GET['sort'] == 'high_to_low') {
        $orderBy = "price DESC";
    }
}

// Build final query
$query = "SELECT * FROM pg_listings WHERE " . implode(" AND ", $whereClauses) . " ORDER BY $orderBy LIMIT $start, $limit";
$result = $conn->query($query);

// Get total PG count for pagination
$totalQuery = "SELECT COUNT(*) AS total FROM pg_listings WHERE " . implode(" AND ", $whereClauses);
$totalResult = $conn->query($totalQuery);
$totalPg = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalPg / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PG Listings - StayNest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* AntD-Style Pagination */
        .ant-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
        }
        .ant-pagination-item, .ant-pagination-prev, .ant-pagination-next {
            display: inline-block;
            min-width: 32px;
            height: 32px;
            line-height: 32px;
            text-align: center;
            border: 1px solid #d9d9d9;
            border-radius: 4px;
            color: rgba(0, 0, 0, 0.85);
            cursor: pointer;
            transition: all 0.3s;
        }
        .ant-pagination-item:hover, .ant-pagination-prev:hover, .ant-pagination-next:hover {
            border-color: #1890ff;
            color: #1890ff;
        }
        .ant-pagination-item-active {
            border-color: #1890ff;
            background-color: #1890ff;
            color: #fff;
        }
        .ant-pagination-item-active:hover {
            border-color: #40a9ff;
            background-color: #40a9ff;
        }
        .ant-pagination-disabled {
            cursor: not-allowed;
            color: rgba(0, 0, 0, 0.25);
        }
        .ant-pagination-disabled:hover {
            border-color: #d9d9d9;
            color: rgba(0, 0, 0, 0.25);
        }

        /* Card Styling for Even Size */
        .card {
            display: flex;
            flex-direction: column;
            height: 100%; /* Ensure all cards have the same height */
        }
        .card-img-top {
            height: 200px; /* Fixed height for images */
            object-fit: cover; /* Ensure images cover the area without distortion */
        }
        .card-body {
            flex: 1; /* Allow card body to grow and fill remaining space */
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Space out content */
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        .view-detials {
            margin-top: auto; /* Push the button to the bottom */
        }

        /* Responsive Grid */
        .row {
            display: flex;
            flex-wrap: wrap;
        }
        .col-md-4 {
            display: flex; /* Ensure columns stretch to the same height */
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h2 class="mb-4">Available PGs</h2>

    <!-- Filters & Search -->
    <form method="GET" action="" class="mb-4">
        <div class="row g-3">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Search by Name or Location" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            </div>
            <div class="col-md-2">
                <select name="location" class="form-select">
                    <option value="">Select Location</option>
                    <option value="City1" <?php echo (isset($_GET['location']) && $_GET['location'] == 'City1' ? 'selected' : ''); ?>>City 1</option>
                    <option value="City2" <?php echo (isset($_GET['location']) && $_GET['location'] == 'City2' ? 'selected' : ''); ?>>City 2</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="price" class="form-select">
                    <option value="">Price Range</option>
                    <option value="low" <?php echo (isset($_GET['price']) && $_GET['price'] == 'low' ? 'selected' : ''); ?>>Below ₹5000</option>
                    <option value="medium" <?php echo (isset($_GET['price']) && $_GET['price'] == 'medium' ? 'selected' : ''); ?>>₹5000 - ₹10000</option>
                    <option value="high" <?php echo (isset($_GET['price']) && $_GET['price'] == 'high' ? 'selected' : ''); ?>>Above ₹10000</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="sort" class="form-select">
                    <option value="">Sort by Price</option>
                    <option value="low_to_high" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'low_to_high' ? 'selected' : ''); ?>>Low to High</option>
                    <option value="high_to_low" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'high_to_low' ? 'selected' : ''); ?>>High to Low</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
            </div>
        </div>

        <!-- Facilities -->
        <div class="mt-3">
            <strong>Facilities:</strong>
            <input type="checkbox" name="facilities[]" value="WiFi" <?php echo (isset($_GET['facilities']) && in_array('WiFi', $_GET['facilities']) ? 'checked' : ''); ?>> WiFi
            <input type="checkbox" name="facilities[]" value="AC" <?php echo (isset($_GET['facilities']) && in_array('AC', $_GET['facilities']) ? 'checked' : ''); ?>> AC
            <input type="checkbox" name="facilities[]" value="Parking" <?php echo (isset($_GET['facilities']) && in_array('Parking', $_GET['facilities']) ? 'checked' : ''); ?>> Parking
        </div>
    </form>

    <!-- Per Page Dropdown -->
    <form method="GET" action="" class="mb-4">
        <div class="row">
            <div class="col-md-2">
                <select name="perpage" class="form-select" onchange="this.form.submit()">
                    <option value="3" <?php echo (isset($_GET['perpage']) && $_GET['perpage'] == 3 ? 'selected' : ''); ?>>3 per page</option>
                    <option value="6" <?php echo (isset($_GET['perpage']) && $_GET['perpage'] == 6 ? 'selected' : ''); ?>>6 per page</option>
                    <option value="9" <?php echo (isset($_GET['perpage']) && $_GET['perpage'] == 9 ? 'selected' : ''); ?>>9 per page</option>
                </select>
            </div>
        </div>
    </form>

    <!-- PG Cards -->
    <div class="row">
        <?php while ($pg = $result->fetch_assoc()) { ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="<?php echo $pg['image_url'] ?: '../assets/default_pg.jpg'; ?>" class="card-img-top" alt="PG Image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $pg['pg_name']; ?></h5>
                        <p class="card-text"><strong>Location:</strong> <?php echo $pg['location']; ?></p>
                        <p class="card-text"><strong>Price:</strong> ₹<?php echo $pg['price']; ?></p>
                        <p class="card-text"><strong>Facilities:</strong> <?php echo $pg['facilities']; ?></p>
                        <div class="view-detials">
                            <a href="pg_details.php?pg_id=<?php echo $pg['pg_id']; ?>" class="btn btn-info">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- AntD-Style Pagination -->
    <div class="ant-pagination">
        <?php if ($page > 1) { ?>
            <a class="ant-pagination-prev" href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page - 1])); ?>">‹</a>
        <?php } else { ?>
            <span class="ant-pagination-prev ant-pagination-disabled">‹</span>
        <?php } ?>

        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
            <a class="ant-pagination-item <?php echo ($i == $page) ? 'ant-pagination-item-active' : ''; ?>" href="?<?php echo http_build_query(array_merge($_GET, ['page' => $i])); ?>"><?php echo $i; ?></a>
        <?php } ?>

        <?php if ($page < $totalPages) { ?>
            <a class="ant-pagination-next" href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page + 1])); ?>">›</a>
        <?php } else { ?>
            <span class="ant-pagination-next ant-pagination-disabled">›</span>
        <?php } ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>