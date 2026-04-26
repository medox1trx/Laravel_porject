import re
from collections import defaultdict

with open(r'c:\Users\Pc\Desktop\Cabinet-medical\routes\web.php', 'r', encoding='utf-8') as f:
    content = f.read()

# This is a very rough check, it doesn't handle groups perfectly but can find explicit names
names = re.findall(r"->name\(['\"](.+?)['\"]\)", content)
counts = defaultdict(int)
for name in names:
    counts[name] += 1

duplicates = [name for name, count in counts.items() if count > 1]
print(f"Explicitly duplicated names: {duplicates}")

# Check for resource routes that might conflict
resources = re.findall(r"Route::resource\(['\"](.+?)['\"]", content)
print(f"Resources: {resources}")
