/*
 FusionCharts JavaScript Library
 Copyright FusionCharts Technologies LLP
 License Information at <http://www.fusioncharts.com/license>

 @author FusionCharts Technologies LLP
 @meta package_map_pack
 @id fusionmaps.Luxer.18.08-09-2012 12:29:03
*/
(function(b){"object"===typeof module&&"undefined"!==typeof module.exports?module.exports=b:b(FusionCharts)})(function(b){b(["private","modules.renderer.js-luxer",function(){var b=this,c=b.hcLib,d=c.chartAPI,h=c.moduleCmdQueue,c=c.injectModuleDependency,a=!!d.geo,f,g,e;f=[{name:"Luxer",revision:18,standaloneInit:!0,baseWidth:569,baseHeight:594,baseScaleFactor:10,entities:{"01":{outlines:[["M",5423,470,"Q",5397,463,5390,456,5385,451,5372,450,5360,448,5354,443,5350,438,5337,437,5322,435,5318,433,5306,
427,5278,423,5251,411,5240,410,5225,408,5206,391,5176,381,5167,376,5154,369,5133,364,5114,351,5099,350,5086,350,5073,339,5058,339,5049,334,5041,329,5026,329,5027,318,5015,318,4999,319,4996,315,4978,311,4966,305,4927,289,4905,284,4901,283,4846,257,4786,242,4774,235,4757,225,4739,225,4729,225,4721,219,4713,213,4707,213,4690,213,4673,203,4651,197,4643,191,4636,186,4626,185,4614,184,4610,182,4580,168,4578,168,4563,158,4546,158,4540,158,4530,150,4522,144,4520,142,"L",4519,141,"Q",4503,129,4495,126,4488,
123,4477,124,4464,125,4457,124,4418,101,4410,98,4385,94,4381,90,4372,82,4358,80,4346,79,4333,70,4322,62,4309,62,4287,56,4282,56,4269,58,4265,57,4258,57,4258,44,4239,44,4226,39,4200,30,4197,29,"L",4197,57,"Q",4201,65,4189,75,"L",4189,106,"Q",4175,101,4175,128,4175,150,4187,152,4187,182,4194,213,4194,225,4205,230,4210,232,4210,260,4210,264,4211,277,4210,288,4197,288,4197,297,4194,314,4194,317,4199,322,4204,327,4204,335,4204,350,4217,359,"L",4217,386,4207,386,"Q",4207,401,4202,414,4202,428,4205,437,
4205,444,4194,468,"L",4194,476,"Q",4197,477,4204,477,4210,478,4209,485,"L",4199,485,4199,491,"Q",4178,491,4177,500,"L",4167,500,"Q",4165,510,4165,532,4158,531,4149,545,4142,557,4129,551,"L",4129,570,4204,570,4204,593,"Q",4214,593,4216,600,4218,604,4220,617,4221,620,4234,653,4234,660,4225,665,"L",4225,684,4235,684,4235,726,"Q",4236,739,4244,745,4251,752,4251,758,4251,761,4249,777,"L",4259,777,4262,779,"Q",4270,784,4278,781,4280,787,4285,791,4289,794,4289,800,4289,809,4288,809,4286,811,4274,810,"L",
4274,823,"Q",4286,829,4293,829,4307,854,4309,859,4310,863,4310,892,4310,917,4308,930,"L",4276,930,"Q",4272,939,4265,945,4262,948,4262,960,4262,972,4269,977,4276,981,4276,993,"L",4287,993,4287,999,"Q",4259,1007,4247,1009,4240,1010,4232,1019,4222,1029,4220,1030,4213,1034,4211,1052,4209,1068,4211,1076,4214,1090,4205,1099,4193,1113,4192,1114,4177,1155,4136,1180,4085,1205,4058,1219,3956,1280,3899,1307,3865,1323,3835,1358,3801,1401,3781,1425,3778,1432,3745,1465,3714,1493,3705,1502,3698,1510,3665,1526,3637,
1539,3624,1559,3612,1576,3581,1588,3552,1598,3544,1616,3540,1624,3532,1644,3527,1653,3515,1662,3495,1673,3487,1677,3473,1685,3464,1697,3413,1767,3406,1783,3399,1799,3373,1823,3345,1848,3336,1857,3279,1917,3261,1928,3238,1941,3219,1965,3188,2003,3187,2007,3186,2010,3183,2021,3181,2030,3171,2027,3179,2042,3163,2046,3148,2049,3154,2060,3155,2070,3144,2075,3131,2081,3129,2092,3112,2092,3096,2100,3084,2109,3083,2109,3049,2109,3014,2106,2955,2090,2955,2090,2946,2090,2934,2095,2922,2100,2911,2100,2877,2101,
2869,2113,2865,2118,2856,2118,2848,2118,2846,2119,2840,2120,2839,2126,2836,2133,2833,2136,2823,2145,2785,2157,2777,2168,2772,2174,2753,2177,2749,2180,2726,2194,2718,2203,2685,2260,2652,2260,2608,2244,2605,2243,"L",2605,2251,2588,2251,"Q",2583,2264,2573,2299,2560,2327,2531,2325,2532,2338,2530,2340,2529,2341,2516,2341,2497,2341,2502,2329,"L",2475,2329,2475,2341,"Q",2461,2335,2453,2346,2445,2358,2437,2354,"L",2437,2377,2462,2408,"Q",2466,2413,2478,2423,2489,2433,2489,2443,2489,2452,2456,2484,2449,2490,
2439,2511,2433,2514,2410,2522,2396,2536,2376,2564,2375,2564,2355,2587,2348,2596,2328,2610,2333,2646,2305,2649,2292,2673,2278,2675,2264,2676,2256,2677,2247,2678,2244,2685,2240,2692,2235,2693,2224,2694,2220,2695,2215,2696,2212,2704,2207,2719,2190,2719,2178,2719,2177,2713,"L",2170,2699,"Q",2128,2722,2009,2784,1954,2823,1925,2836,1916,2840,1890,2863,1870,2881,1850,2880,1844,2890,1815,2895,1787,2900,1785,2916,1769,2913,1748,2923,1723,2936,1707,2937,1666,2933,1655,2939,1630,2951,1617,2949,1565,2940,1538,
2967,1524,2982,1508,3027,1469,3023,1437,3033,1399,3045,1388,3071,1337,3071,1298,3077,1290,3079,1287,3088,1284,3096,1267,3096,1242,3105,1225,3104,1207,3103,1188,3121,1163,3146,1158,3148,1114,3185,1091,3188,1089,3188,1088,3188,1061,3184,1030,3194,994,3208,977,3212,929,3219,910,3222,911,3231,904,3233,893,3234,887,3237,872,3243,853,3243,826,3243,820,3241,808,3237,810,3220,"L",797,3220,797,3210,"Q",786,3212,779,3218,773,3222,761,3222,759,3231,745,3231,736,3231,735,3236,733,3242,728,3243,686,3250,680,3254,
666,3262,623,3317,615,3327,588,3336,563,3343,554,3361,548,3372,514,3382,504,3385,493,3394,486,3400,472,3400,480,3437,460,3463,448,3479,418,3505,412,3547,398,3566,379,3590,340,3589,336,3610,307,3639,275,3670,269,3688,258,3715,252,3719,244,3724,238,3733,235,3738,231,3746,220,3746,217,3753,215,3757,210,3772,199,3793,199,3803,"L",185,3803,"Q",189,3820,180,3829,172,3838,176,3851,176,3852,176,3853,176,3859,176,3880,176,3900,172,3910,164,3907,162,3912,161,3915,162,3924,"L",151,3924,"Q",151,3954,147,3996,
"L",134,3996,134,4021,"Q",115,4014,115,4031,115,4041,118,4065,116,4080,111,4092,108,4101,107,4119,106,4166,101,4232,91,4231,85,4231,74,4233,74,4247,51,4247,40,4249,"L",40,4258,"Q",64,4256,78,4264,82,4277,86,4285,86,4286,86,4304,86,4312,81,4332,76,4353,76,4374,76,4381,84,4430,84,4439,90,4456,95,4473,95,4490,95,4532,78,4604,"L",67,4604,"Q",67,4608,65,4618,"L",74,4618,"Q",70,4628,80,4641,90,4654,88,4667,93,4680,97,4694,97,4703,91,4708,85,4712,86,4723,86,4725,86,4728,85,4738,79,4760,71,4785,72,4801,72,
4825,60,4842,45,4862,44,4872,"L",30,4872,30,4893,"Q",43,4896,59,4904,"L",59,4927,44,4927,44,4950,"Q",51,4957,54,4971,57,4987,65,4998,83,5020,90,5055,95,5077,120,5110,148,5147,153,5159,159,5173,177,5208,193,5242,197,5266,206,5317,211,5330,221,5358,249,5362,252,5369,266,5387,267,5415,282,5436,298,5458,296,5493,295,5527,313,5568,328,5603,366,5636,419,5682,428,5692,450,5718,490,5748,512,5765,560,5801,567,5807,577,5818,586,5826,596,5826,612,5827,627,5854,"L",696,5900,1358,5900,"Q",1366,5899,1377,5888,
1382,5883,1400,5884,1402,5884,1429,5873,1445,5874,1453,5870,1519,5837,1544,5827,1609,5800,1746,5750,1760,5744,1804,5736,1822,5729,1852,5714,1861,5712,1898,5695,1931,5680,1955,5679,1967,5679,1979,5670,1994,5659,2006,5656,2028,5650,2054,5637,2098,5626,2101,5624,"L",2125,5609,"Q",2125,5609,2142,5602,2164,5598,2184,5588,2201,5587,2227,5568,2257,5567,2269,5560,2302,5542,2311,5542,2323,5542,2335,5534,2347,5525,2353,5522,2385,5519,2398,5510,2425,5492,2482,5474,2506,5467,2568,5443,2594,5441,2614,5429,2636,
5417,2652,5414,2657,5414,2686,5396,2717,5393,2734,5385,2756,5375,2813,5355,2823,5354,2832,5347,2842,5339,2850,5339,2863,5338,2868,5332,2875,5325,2884,5322,2894,5320,2904,5315,2914,5310,2929,5306,2944,5302,2972,5292,3009,5278,3059,5239,3124,5189,3142,5177,3158,5162,3181,5149,3205,5133,3221,5124,3235,5116,3296,5067,3318,5047,3332,5035,3359,5012,3376,5012,3399,4991,3407,4978,"L",3439,4952,"Q",3440,4951,3440,4950,3466,4938,3471,4929,3475,4923,3490,4915,3505,4906,3531,4883,3556,4860,3559,4857,3589,4840,
3596,4835,3603,4832,3622,4814,3633,4803,3658,4789,3685,4773,3694,4766,3775,4704,3803,4686,3818,4677,3831,4662,3849,4642,3863,4629,3899,4594,3912,4582,3912,4581,3913,4581,3983,4507,3998,4492,4014,4477,4031,4458,4048,4439,4061,4427,4145,4348,4182,4305,4197,4288,4217,4272,4237,4256,4244,4246,4250,4236,4273,4211,4296,4186,4310,4178,4323,4171,4343,4142,4349,4138,4377,4115,4418,4081,4433,4053,4534,3947,4586,3901,4620,3867,4635,3851,4650,3834,4654,3832,4669,3824,4688,3803,4712,3774,4726,3760,4740,3745,4751,
3736,4761,3726,4795,3696,4828,3666,4881,3614,4933,3562,4938,3555,4943,3548,4960,3530,4976,3512,4985,3504,4995,3496,4999,3490,5008,3475,5024,3466,5026,3464,5028,3463,5045,3445,5086,3403,5130,3359,5148,3342,5165,3324,5192,3294,5219,3265,5258,3229,5296,3193,5321,3168,5345,3142,5371,3113,5386,3096,5427,3061,5472,3020,5467,3003,5466,2953,5471,2904,5477,2855,5476,2837,5484,2803,5485,2770,5485,2743,5485,2728,5485,2702,5489,2691,5493,2685,5496,2680,5500,2671,5499,2657,"L",5499,2618,"Q",5501,2548,5503,2538,
5504,2533,5507,2467,5509,2432,5519,2413,5521,2338,5522,2300,5532,2270,5531,2233,5529,2177,5541,2156,"L",5541,2081,"Q",5540,2067,5546,2046,5552,2026,5551,2010,5549,1984,5557,1936,5563,1905,5564,1800,5564,1799,5564,1797,5560,1713,5567,1698,5579,1672,5576,1613,5575,1591,5583,1574,5591,1558,5590,1537,5585,1483,5596,1463,5602,1453,5599,1386,5608,1339,5609,1322,"L",5609,1245,"Q",5617,1198,5618,1179,5618,1108,5628,1094,"L",5628,1008,"Q",5633,974,5633,939,"L",5633,894,"Q",5645,882,5647,872,5653,836,5648,
794,5647,778,5655,760,5663,742,5662,730,5666,607,5666,595,5668,571,5667,566,5666,559,5653,552,5652,552,5650,552,5642,549,5620,540,5605,539,5598,539,5582,526,5581,525,5564,516,5536,510,5520,512,5514,509,5500,495,5499,495,5482,496,5474,495,5465,487,5458,483,"Q",5433,478,5423,470,"Z"]],label:"Luxer",shortLabel:"LU",labelPosition:[284.9,363.9],labelAlignment:["center","middle"]}}}];e=f.length;if(a)for(;e--;)a=f[e],d(a.name.toLowerCase(),a,d.geo);else for(;e--;)a=f[e],g=a.name.toLowerCase(),c("maps",g,
1),h.maps.unshift({cmd:"_call",obj:window,args:[function(a,c){d.geo?d(a,c,d.geo):b.raiseError(b.core,"12052314141","run","JavaScriptRenderer~Maps._call()",Error("fusioncharts.maps.js is required in order to define vizualization"))},[g,a],window]})}])});
