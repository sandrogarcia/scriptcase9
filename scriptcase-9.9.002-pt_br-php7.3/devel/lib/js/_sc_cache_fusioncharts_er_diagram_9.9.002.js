function showERDiagram(divToPlot, strApls)
{
    dataset = [];
    x = 60;
    y = ($('#' + divToPlot).height()-80);
    rand = 0;
    for(it=0;it<strApls.nodes.length;it++)
    {
        if(typeof strApls.nodes_nolink[ it ] === 'undefined') {
            dataset.push( {
                id: strApls.nodes[it].id,
                label: strApls.nodes[it].name,
                x: x,
                y: y+rand,
                shape: "rectangle",
                width: strApls.nodes[it].width,
                height: strApls.nodes[it].height,
                radius: "20",
                color: strApls.nodes[it].color,
            } );

            if(rand != 30)
            {
                rand = 30;
            }else
            {
                rand = -30;
            }

            x += strApls.nodes[it].width + 50;

            if((x + strApls.nodes[it].width) > ($('#' + divToPlot).width()-120))
            {
                x = 60;
                y -= 110;
                rand = 0;
            }
        }
    }

    console.log(dataset);

    x = 70;
    y -= 200;
    $.each(strApls.nodes_nolink, function(it, v) {
        dataset.push( {
            id: strApls.nodes[it].id,
            label: strApls.nodes[it].name,
            x: x,
            y: y,
            shape: "rectangle",
            width: strApls.nodes[it].width,
            height: strApls.nodes[it].height,
            radius: "20"
        } );

        x += strApls.nodes[it].width + 80;

        if(x > 1800)
        {
            x = 80;
            y -= 50;
        }
    });

    links = [];
    for(it=0;it<strApls.links.length;it++)
    {
        links.push( {
            from: strApls.nodes[ strApls.links[it].source ].name,
            to: strApls.nodes[ strApls.links[it].target ].name,
            arrowatstart: "0",
            arrowatend: "1",
            alpha: "100",
            //label: jsonObj[it].text + " -> " + jsonObj[it].toText,
            //color: color,
            //link: "javascript:editRelationFK('"+ jsonObj[it].from +"', '"+ jsonObj[it].to +"');"
            yaxismaxvalue: ($('#' + divToPlot).height()-50),
            yaxisminvalue: "0",
            divlinealpha: "0"
        } );
    }

    const dataSource = {
        chart: {
            theme: "fusion",
            viewmode: "1",
            showrestorebtn: "0",
            valuefontcolor: "#FFFFFF",
            yaxismaxvalue: ($('#' + divToPlot).height()-60),
            yaxisminvalue: "10",
            xaxisminvalue: "10",
            "chartLeftMargin": "0",
            "chartTopMargin": "0",
            "chartRightMargin": "0",
            "chartBottomMargin": "0",
            "showCanvasBorder": "0",
            "canvasbgColor": "#ffffff",
        },
        dataset: [
            {
                data: dataset
            }
        ],
        connectors: [
            {
                stdthickness: "1",
                connector: links
            }
        ]
    };

    FusionCharts.ready(function() {
        var myChart = new FusionCharts({
            type: "dragnode",
            renderAt: divToPlot,
            width: ($('#' + divToPlot).width()),
            height: ($('#' + divToPlot).height()),
            dataFormat: "json",
            dataSource
        }).render();


    });
}