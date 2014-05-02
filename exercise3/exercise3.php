<?php
/**
 * Created by Ethan Sundstrom
 *
 * This is a simple procedural file that:
 * 1. creates a couple 10k-element arrays of random integers
 * 2. removes non-matched values from each array
 * 3. combines the matched results
 * 4. removes duplicates
 * 5. sorts the array elements by value in ascending order
 *
 */

// Generate two 10,000-element arrays with each key being a random number between 1 and 10,000.
for ($i = 0; $i < 10000; $i++)
{
    // Create a random number in the desired range, and push it into $rand_array_A
    $rand = rand(1, 10000);
    $rand_array_A[] = $rand;

    // Create another random number in the desired range, and push it into $rand_array_B
    $rand = rand(1, 10000);
    $rand_array_B[] = $rand;
}

// Output the source arrays
echo '<pre style="color: red;">';
print_r($rand_array_A);
echo '</pre>';
echo '<pre style="color: green;">';
print_r($rand_array_B);
echo '</pre>';


// Create a pre-processing timestamp to benchmark the matching, filtering and sorting routine below.
$starttime = microtime(true);


// Create lists of the element values that are present within only one of the two random arrays:

// Get an array of the values that are present within $rand_array_A but not present within $rand_array_B.
$diff_A = array_diff($rand_array_A, $rand_array_B);
// Get an array of the values that are present within $rand_array_B but not present within $rand_array_A.
$diff_B = array_diff($rand_array_B, $rand_array_A);

// Trim out the unmatched values from each array, so both are left with just the matching values:

// Loop through each of the values in $rand_array_A that don;t exist within $rand_array_B...
foreach ($diff_A as $k => $v)
{
    // ... and unset the element from the array.
    unset($rand_array_A[$k]);
}

// Loop through each of the values in $rand_array_B that don;t exist within $rand_array_A...
foreach ($diff_B as $k => $v)
{
    // ... and unset the element from the array.
    unset($rand_array_B[$k]);
}

// Merge the two arrays into one array for later matching routine.
$merged_array = array_merge($rand_array_A,$rand_array_B);

//  Loop through each element of the combined array...
foreach ($merged_array as $k => $v)
{
    // ... and set the key index of $v to true. This creates an array of elements with the element index
    // keys as the matching numbers from the combined array.
    $matches_array[$v] = true;
}

// Swap the key index into the value for each element.
$matches_array = array_keys($matches_array);

// Sort the array elements by value, ascending.
sort($matches_array);




// Compute the elapsed time by subtracting the start time from the end time.
$totaltime = (microtime(true) - $starttime);


// Output the final matched, merged and sorted array.
echo '<pre style="color: green;">';
print_r($matches_array);
echo '</pre>';

// Output the total processing time (which excludes the time spent rendering of the arrays to the browser.)
echo "<hr />Run time: $totaltime seconds.";