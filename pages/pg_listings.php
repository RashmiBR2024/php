<?php
include '../config.php'; // Database connection

$limit = 6; // Number of PGs per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
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
</head>
<body>

<div class="container mt-4">
    <h2 class="mb-4">Available PGs</h2>

    <!-- Filters & Search -->
    <form method="GET" action="" class="mb-4">
        <div class="row g-3">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Search by Name or Location">
            </div>
            <div class="col-md-2">
                <select name="location" class="form-select">
                    <option value="">Select Location</option>
                    <option value="City1">City 1</option>
                    <option value="City2">City 2</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="price" class="form-select">
                    <option value="">Price Range</option>
                    <option value="low">Below ₹5000</option>
                    <option value="medium">₹5000 - ₹10000</option>
                    <option value="high">Above ₹10000</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="sort" class="form-select">
                    <option value="">Sort by Price</option>
                    <option value="low_to_high">Low to High</option>
                    <option value="high_to_low">High to Low</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
            </div>
        </div>

        <!-- Facilities -->
        <div class="mt-3">
            <strong>Facilities:</strong>
            <input type="checkbox" name="facilities[]" value="WiFi"> WiFi
            <input type="checkbox" name="facilities[]" value="AC"> AC
            <input type="checkbox" name="facilities[]" value="Parking"> Parking
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
                        <a href="pg_details.php?pg_id=<?php echo $pg['pg_id']; ?>" class="btn btn-info">View Details</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php if ($page > 1) { ?>
                <li class="page-item"><a class="page-link" href="?page=1">First</a></li>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a></li>
            <?php } ?>

            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php } ?>

            <?php if ($page < $totalPages) { ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a></li>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $totalPages; ?>">Last</a></li>
            <?php } ?>
        </ul>
    </nav>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
