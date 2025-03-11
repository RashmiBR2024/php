<?php
include '../config.php'; // Database connection

$limit = isset($_GET['perpage']) ? (int)$_GET['perpage'] : 3; // Default to 3 PGs per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Base query
$whereClauses = ["available = 'yes'"];
$params = [];
$types = "";

// Search Filter
if (!empty($_GET['search'])) {
    $search = $_GET['search'];
    $whereClauses[] = "(pg_name LIKE ? OR location LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $types .= "ss"; // Two strings for search
}

// Location Filter
if (!empty($_GET['location'])) {
    $location = $_GET['location'];
    $whereClauses[] = "location = ?";
    $params[] = $location;
    $types .= "s"; // One string for location
}

// Price Filter
if (!empty($_GET['price'])) {
    if ($_GET['price'] == 'low') {
        $whereClauses[] = "price < ?";
        $params[] = 5000;
        $types .= "i"; // One integer for price
    } elseif ($_GET['price'] == 'medium') {
        $whereClauses[] = "price BETWEEN ? AND ?";
        $params[] = 5000;
        $params[] = 10000;
        $types .= "ii"; // Two integers for price range
    } elseif ($_GET['price'] == 'high') {
        $whereClauses[] = "price > ?";
        $params[] = 10000;
        $types .= "i"; // One integer for price
    }
}

// Facility Filter (Example: WiFi, AC, Parking)
if (!empty($_GET['facilities'])) {
    $selectedFacilities = $_GET['facilities'];
    foreach ($selectedFacilities as $facility) {
        $whereClauses[] = "facilities LIKE ?";
        $params[] = "%$facility%";
        $types .= "s"; // One string per facility
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
$query = "SELECT * FROM pg_listings WHERE " . implode(" AND ", $whereClauses) . " ORDER BY $orderBy LIMIT ?, ?";
$params[] = $start;
$params[] = $limit;
$types .= "ii"; // Two integers for LIMIT

// Prepare and execute the main query
$stmt = $conn->prepare($query);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

// Total count query
$totalQuery = "SELECT COUNT(*) AS total FROM pg_listings WHERE " . implode(" AND ", $whereClauses);
$stmtTotal = $conn->prepare($totalQuery);

// Remove LIMIT parameters for the total count query
$totalParams = array_slice($params, 0, -2);
$totalTypes = substr($types, 0, -2);

if (!empty($totalParams)) {
    $stmtTotal->bind_param($totalTypes, ...$totalParams);
}
$stmtTotal->execute();
$totalResult = $stmtTotal->get_result();
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
        /* Your existing CSS styles */
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Available PGs</h2>

        <!-- Filters & Search -->
        <form method="GET" action="" class="mb-4" id="filterForm">
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Search by Name or Location" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" oninput="debounceFilter()">
                </div>
                <div class="col-md-2">
                    <select name="location" class="form-select" onchange="debounceFilter()">
                        <option value="">Select Location</option>
                        <option value="City1" <?php echo (isset($_GET['location']) && $_GET['location'] == 'City1' ? 'selected' : ''); ?>>City 1</option>
                        <option value="City2" <?php echo (isset($_GET['location']) && $_GET['location'] == 'City2' ? 'selected' : ''); ?>>City 2</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="price" class="form-select" onchange="debounceFilter()">
                        <option value="">Price Range</option>
                        <option value="low" <?php echo (isset($_GET['price']) && $_GET['price'] == 'low' ? 'selected' : ''); ?>>Below ₹5000</option>
                        <option value="medium" <?php echo (isset($_GET['price']) && $_GET['price'] == 'medium' ? 'selected' : ''); ?>>₹5000 - ₹10000</option>
                        <option value="high" <?php echo (isset($_GET['price']) && $_GET['price'] == 'high' ? 'selected' : ''); ?>>Above ₹10000</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="sort" class="form-select" onchange="debounceFilter()">
                        <option value="">Sort by Price</option>
                        <option value="low_to_high" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'low_to_high' ? 'selected' : ''); ?>>Low to High</option>
                        <option value="high_to_low" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'high_to_low' ? 'selected' : ''); ?>>High to Low</option>
                    </select>
                </div>
            </div>

            <!-- Facilities -->
            <div class="mt-3">
                <strong>Facilities:</strong>
                <input type="checkbox" name="facilities[]" value="WiFi" <?php echo (isset($_GET['facilities']) && in_array('WiFi', $_GET['facilities']) ? 'checked' : ''); ?> onchange="debounceFilter()"> WiFi
                <input type="checkbox" name="facilities[]" value="AC" <?php echo (isset($_GET['facilities']) && in_array('AC', $_GET['facilities']) ? 'checked' : ''); ?> onchange="debounceFilter()"> AC
                <input type="checkbox" name="facilities[]" value="Parking" <?php echo (isset($_GET['facilities']) && in_array('Parking', $_GET['facilities']) ? 'checked' : ''); ?> onchange="debounceFilter()"> Parking
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

    <!-- Debounce Script -->
    <script>
        let debounceTimer;

        function debounceFilter() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                document.getElementById("filterForm").submit();
            }, 300); // 300ms debounce
        }
    </script>
</body>
</html>