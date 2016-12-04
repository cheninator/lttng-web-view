
export interface GridItem {
    dataGsX: number;
    dataGsY: number;
    dataGsWidth: number;
    dataGsHeight: number;
}

export interface ChartGridItem extends GridItem {
    title: string
    chartType: string;
    name: string;
}